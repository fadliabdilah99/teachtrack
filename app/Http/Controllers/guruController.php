<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\materiGuru;
use App\Models\rombel;
use App\Models\rombel_mapel_guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class guruController extends Controller
{
    public function index()
    {
        // jumlah siswa yang di ajar
        $data['jumlahSiswa'] = User::whereHas('rombel', function ($q) {
            $q->whereHas('mapelGuru', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        })->count();

        // jumlah kelas yang di ajar
        $data['jumlahKelas'] = rombel::whereHas('mapelGuru', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->count();

        // jumlah materi
        $data['jumlahMateri'] = materiGuru::where('user_id', Auth::user()->id)->count();

        // jadwal mengajar hari ini
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        // $data['hari_ini'] = $hari[Carbon::now()->format('w')];
        $data['hari_ini'] = 'senin';
        $data['jadwals'] = rombel_mapel_guru::whereHas('guruMapel', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->where('hari', $data['hari_ini'])->orderBy('dari', 'asc')->get();

        // jam saat ini
        // $jamSekarang = (int) Carbon::now('Asia/Jakarta')->format('H');
        $jamSekarang = 13;
        $jadwal = null;
        foreach ($data['jadwals'] as $day) {
            $data['jamAwal'] = (int) $day->dari;
            $data['jamAkhir'] = (int) $day->sampai;
            // pengecekan berada dalam rentang jam pelajaran
            if ($jamSekarang >= $data['jamAwal'] && $jamSekarang < $data['jamAkhir']) {
                $jadwal = $day;
                break;
            }
        }
        // dd($data['jadwals']);

        $data['jadwal'] = $jadwal;
        // dd($data['jadwal']);
        return view('guru.home.index')->with($data);
    }




    // admin ----------------------------------------------------------------------
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'NoUnik' => 'required',
            'role' => 'required',
        ]);


        User::create(
            [
                'name' => $request->name,
                'rombel_id' => $request->rombel,
                'NoUnik' => $request->NoUnik,
                'role' => $request->role,
                'password' => Hash::make('*' . $request->NoUnik),
                'email' => $request->NoUnik . '@gmail.com',
            ]
        );

        return redirect()->back()->with('success', 'berhasil ditambahkan');
    }

    public function addmapel(Request $request)
    {
        // Validasi input untuk memastikan ID ada di tabel terkait
        $request->validate([
            'mapel_id' => 'required',
            'guru_id' => 'required',
        ]);

        if (guru_mapel::where('mapel_id', $request->mapel_id)->where('user_id', $request->guru_id)->first() != null) {
            return redirect()->back()->with('error', 'guru tersebut sudah terdaftar di mapel ini');
        };

        guru_mapel::create([
            'user_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id
        ]);
        return redirect()->back()->with('success', 'pengajar berhasil ditambahkan');
    }

    public function profile(Request $request){
        return view('guru.profile.index');
    }
}
