<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\jurusan;
use App\Models\mapel;
use App\Models\notification;
use App\Models\rombel;
use App\Models\seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class userController extends Controller
{
    public function index()
    {
        $user = User::with(['rombel', 'siswa', 'mapel'])->get();
        $data['jurusan'] = jurusan::get();
        $data['guru'] = $user->where('role', 'guru');
        $data['murid'] = $user->where('role', 'KM');
        $data['total'] = $user->groupBy('rombel_id')->map->count();
        $data['orangtua'] = $user->where('role', 'ortu');
        $data['mapellist'] = guru_mapel::with('mapel', 'user')->get();

        // Ambil semua rombel beserta jadwalnya
        $data['rombe'] = Rombel::with('jadwal.guruMapel.mapel', 'jadwal.guruMapel.user')->get();

        return view('admin.user.index')->with($data);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function pengajuan(Request $request)
    {
        $request->validate([
            'namaToko' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required',
        ]);
        // dd($request->all());
        if (User::where('NoUnik', Auth::user()->id . Auth::user()->NoUnik)->where('role', 'pengajuan')->first() != null) {
            return redirect()->back()->with('error', 'sedang pengajuan');
        } else if (User::where('NoUnik', Auth::user()->id . Auth::user()->NoUnik)->where('role', 'penjual')->first() != null) {
            return redirect()->back()->with('error', 'sudah terdaftar');
        };


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/identitas'), $fileName);
            $request->merge(['fotoProfile' => $fileName]);
        }

        $user = User::create([
            'name' => 'penjual' . $request->name,
            'NoUnik' => Auth::user()->id . Auth::user()->NoUnik,
            'role' => 'pengajuan',
            'password' => Hash::make('*' . Auth::user()->NoUnik),
            'email' => 'penjual' . Auth::user()->NoUnik . '@gmail.com',
        ]);

        seller::create([
            'user_id' => $user->id,
            'owner_id' => Auth::user()->id,
            'namaToko' => $request->namaToko,
            'deskripsi' => $request->deskripsi,
            'identitas' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Pengajuan Berhasil Akun penjual berhasil');
    }

    public function konfirseller(Request $request)
    {
        $user = User::where('id', $request->user_id)->with('seller')->first();

        notification::create([
            'user_id' => $user->seller->owner_id,
            'title' => 'Akun Penjualan telah dikonfirmasi',
            'message' => 'akun Penjual ' . $user->name . ' telah dikonfirmasi, dengan email ' . $user->email . ' dan password sama dengan NIS, segera lakukan penggantian password!',
            'status' => 'unread',
        ]);

        $user->update([
            'role' => 'penjual',
        ]);
        return redirect()->back()->with('success', 'Konfirmasi Akun penjual berhasil');
    }
    public function tolakseller(Request $request)
    {
        $user = User::find($request->user_id);

        notification::create([
            'user_id' => $user->seller->owner_id,
            'title' => 'Pengajuan akun di tolak',
            'message' => 'pengajuan akun penjualan di tolak, mohon menghubungi admin untuk informasi lebih lanjut',
            'status' => 'unread',
        ]);

        $user->seller->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Tolak Akun penjual berhasil');
    }
}
