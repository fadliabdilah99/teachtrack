<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class kelasController extends Controller
{
    public function index()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $data['hari_ini'] = $hari[Carbon::now()->format('w')];

        $data['kelas'] = rombel::where('id', Auth::user()->rombel_id)->with('jurusan')->first();
        $data['siswas'] = User::whereIn('role', ['siswa', 'KM'])->where('rombel_id', $data['kelas']->id)->get();
        $data['rombels'] = rombel::with('jadwal.guruMapel.mapel')->where('id', Auth::user()->rombel_id)->get();

        $rombe = $data['rombels']->flatMap(function ($rombel) {
            return $rombel->jadwal;
        })->groupBy('hari');

        // Jadwal hari ini
        $days = $rombe[$data['hari_ini']] ?? collect([]);
        $currentHour = (int) Carbon::now('Asia/Jakarta')->format('H');

        $currentLesson = null;
        foreach ($days as $day) {
            // Pastikan dari dan sampai adalah integer yang sesuai dengan jam
            $startHour = (int) $day->dari;
            $endHour = (int) $day->sampai;

            // Cek apakah waktu saat ini berada dalam rentang jam pelajaran
            if ($currentHour >= $startHour && $currentHour < $endHour) {
                $currentLesson = $day;
                break;
            }
        }
        $data['currentLesson'] = $currentLesson;

        return view('siswa.kelas.index')->with($data);
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
}
