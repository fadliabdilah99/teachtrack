<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\materi_rombel;
use App\Models\materiGuru;
use App\Models\rombel_mapel_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class rombelController extends Controller
{
    public function mapelRombel(Request $request)
    {
        $request->validate([
            'rombel_id' => 'required|integer',
            'mapel_id' => 'required|integer',
            'dari' => 'required|integer',
            'sampai' => 'required|integer',
            'hari' => 'required|string',
        ]);

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



    public function gurumateri()
    {
        $data['mapel'] = guru_mapel::where('user_id', Auth::user()->id)->get();
        $data['listMateri'] = materiGuru::where('user_id', Auth::user()->id)->get();
        $data['kelas'] = rombel_mapel_guru::whereIn('guru_mapel_id', $data['mapel']->pluck('id'))
            ->with('guruMapel', 'rombel', 'materiGuru')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->get();
            
        return view('guru.kelas.index')->with($data);
    }
    public function addmateri(Request $request)
    {
        $request->validate([
            'rombel_mapel_guru_id' => 'required',
            'materi_guru_id' => 'required',
            'rombel_id' => 'required',
        ]);


        if (materi_rombel::where('rombel_id', $request->rombel_id)->where('materiGuru_id', $request->materiGuru_id)->first() != null) {
            return redirect()->back()->with('error', 'materi telah di tambahkan ke kelas ini');
        }
        materi_rombel::create($request->all());
        return redirect()->back()->with('success', 'materi berhasil ditambahkan');
    }
}
