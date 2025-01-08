<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\nilai;
use App\Models\post;
use App\Models\rombel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class siswaController extends Controller
{
    public function index()
    {
        $data['rombels'] = rombel::with('jadwal.guruMapel.mapel')->where('id', Auth::user()->rombel_id)->get();
        $data['groupedByHari'] = $data['rombels']->flatMap(function ($rombel) {
            return $rombel->jadwal;
        })->groupBy('hari');

        // postingan
        $data['postingan'] = post::with(['user', 'comments', 'likes', 'fotoPost'])->latest()->get();



        // mencari kelas dengan rata rata nilai tertinggi
        $data['kelasRank'] = rombel::with('user.nilai')
            ->get()
            ->map(function ($rombel) {
                $totalNilai = 0;
                $jumlahNilai = 0;

                foreach ($rombel->user as $user) {
                    $totalNilai += $user->nilai->sum('nilai');
                    $jumlahNilai += $user->nilai->count();
                }

                $rombel->rataRataNilai = $jumlahNilai > 0 ? $totalNilai / $jumlahNilai : 0;
                return $rombel;
            })
            ->sortByDesc('rataRataNilai')
            ->first();


        // mencari siswa dengan nilai tertinggi
        $data['siswaNilaiTertinggi'] = User::with('nilai')
            ->get()
            ->map(function ($user) {
                $user->tes = $user->nilai->max('nilai');
                return $user;
            })
            ->sortByDesc('tes')
            ->first();

        return view('siswa.home.index')->with($data);
    }

    public function addsiswa(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'NoUnik' => 'required',
        ]);


        $user = User::create([
            'rombel_id' => Auth::user()->rombel_id,
            'name' => $request->name,
            'NoUnik' => $request->NoUnik,
            'role' => $request->role,
            'password' => Hash::make('*' . $request->NoUnik),
            'email' => $request->NoUnik . '@gmail.com',
        ]);
        User::create([
            'name' => 'orang tua ' . $request->name,
            'NoUnik' =>  $user->id,
            'role' => 'ortu',
            'password' => Hash::make('*' . $request->NoUnik),
            'email' => 'OT' . $request->NoUnik . '@gmail.com',
        ]);
        return redirect()->back()->with('success', 'berhasil menambahkan Ketua Murid & akun Orang Tua');
    }
}
