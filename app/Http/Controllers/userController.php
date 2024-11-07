<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use App\Models\rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class userController extends Controller
{
    public function index()
    {
        $user = User::with('rombel')->get();
        $data['jurusan'] = jurusan::get();
        $data['guru'] = $user->where('role', 'guru');
        $data['murid'] = $user->where('role', 'KM');
        $data['total'] = $user->groupBy('rombel_id')->map->count();
        $data['orangtua'] = $user->where('role', 'orangtua');
        return view('admin.user.index')->with($data);
    }

    public function addsiswa(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rombel' => 'required',
            'NoUnik' => 'required',
        ]);

        if (rombel::where('jurusan_id', $request->rombel)->where('kelas', $request->kelas)->first() != null) {
            return redirect()->back()->with('error', 'kelas sudah ada');
        };

        $rombel = rombel::create([
            'kelas' => $request->kelas,
            'jurusan_id' => $request->rombel,
        ]);


        $user = User::create([
            'rombel_id' => $rombel->id,
            'name' => $request->name,
            'NoUnik' => $request->NoUnik,
            'role' => 'KM',
            'password' => Hash::make('*' . $request->NoUnik),
            'email' => $request->NoUnik . '@gmail.com',
        ]);
        User::create([
            'name' => 'orang tua' . $request->name,
            'NoUnik' =>  $user->id,
            'role' => 'ortu',
            'password' => Hash::make('*' . $request->NoUnik),
            'email' => 'OT' . $request->NoUnik . '@gmail.com',
        ]);
        return redirect()->back()->with('success', 'berhasil menambahkan Ketua Murid & akun Orang Tua');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
