<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\materi_rombel;
use App\Models\materiGuru;
use App\Models\materiStrukture;
use App\Models\questions;
use App\Models\rombel;
use App\Models\rombel_mapel_guru;
use App\Models\User;
use App\Models\user_materi_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class rombelController extends Controller
{

    // menambah jadwal guru di kelas tertentu akses admin
    public function mapelRombel(Request $request)
    {
        $request->validate([
            'rombel_id' => 'required|integer',
            'mapel_id' => 'required|integer',
            'dari' => 'required|integer',
            'sampai' => 'required|integer',
            'hari' => 'required|string',
        ]);

        $existingSchedule = rombel_mapel_guru::where('guru_mapel_id', $request->mapel_id)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('dari', [$request->dari, $request->sampai])
                      ->orWhereBetween('sampai', [$request->dari, $request->sampai]);
            })
            ->first();

        if ($existingSchedule) {
            return redirect()->back()->with('error', 'Guru tersebut sudah memiliki jadwal di kelas lain pada jam yang sama');
        }
        $mapel = rombel_mapel_guru::where('rombel_id', $request->rombel_id)->where('hari', $request->hari)->first();
        if ($mapel != null && $mapel->dari >= $request->dari && $mapel->sampai <= $request->sampai) {
            return redirect()->back()->with('error', 'Jam tersebut sudah terisi oleh mapel lain');
        }

        rombel_mapel_guru::create([
            'rombel_id' => $request->rombel_id,
            'guru_mapel_id' => $request->mapel_id,
            'dari' => $request->dari,
            'sampai' => $request->sampai,
            'hari' => $request->hari
        ]);

        return redirect()->back()->with('success', 'berhasil menambahkan pengajar');
    }



    // halaman kelas guru
    public function gurumateri()
    {
        $data['mapel'] = guru_mapel::where('user_id', Auth::user()->id)->get();

        // mengambil jadwal guru berdasarkan mapel
        $data['jadwal'] = rombel_mapel_guru::whereIn('guru_mapel_id', $data['mapel']->pluck('id'))
            ->with('guruMapel', 'rombel', 'materiGuru')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->get();

        $data['rombel'] = $data['jadwal']->pluck('rombel')->unique('id');




        return view('guru.kelas.index')->with($data);
    }



    // fungsi untuk menambahkan materi ke rombel dan ke siswa
    public function addmateri(Request $request)
    {
        $request->validate([
            'rombel_mapel_guru_id' => 'required',
            'materi_guru_id' => 'required',
            'rombel_id' => 'required',
        ]);

        // fungsi untuk membatasi jika materi sudah ada di rombel di jam yang sama
        $materiRombel = materi_rombel::where('rombel_id', $request->rombel_id)->where('rombel_mapel_guru_id', $request->rombel_mapel_guru_id)->get();
        foreach ($materiRombel as $m) {
            if ($m->materi_guru_id == $request->materi_guru_id) {
                return redirect()->back()->with('error', 'Materi sudah ada di rombel dam di jam yang sama');
            }
        }

        $materiGuru = materiGuru::where('id', $request->materi_guru_id)->first();

        if ($materiGuru->jenis == 'materi') {
            $materi = materiStrukture::where('materiGuru_id', $request->materi_guru_id)->get();
        } elseif ($materiGuru->jenis == 'ujian(fixed)') {
            $materi = questions::where('materi_guru_id', $request->materi_guru_id)->get();
        }


        // Menambahkan seluruh struktur ke siswa
        $user = User::where('rombel_id', $request->rombel_id)->get();
        foreach ($user as $u) {
            foreach ($materi as $m) {
                $data = [
                    'user_id' => $u->id,
                    'materi_guru_id' => $request->materi_guru_id,
                    'progres' => 2,
                ];

                if ($materiGuru->jenis == 'materi') {
                    $data['materiStrukture_id'] = $m->id;
                } elseif ($materiGuru->jenis == 'ujian') {
                    $data['question_id'] = $m->id;
                }

                user_materi_guru::create($data);
            }
        }


        materi_rombel::create($request->all());
        return redirect()->back()->with('success', 'materi berhasil ditambahkan');
    }

    public function deleteJadwal($id){
        rombel_mapel_guru::where('id', $id)->delete();
        return redirect()->back()->with('success', 'jadwal berhasil dihapus');
    }


}
