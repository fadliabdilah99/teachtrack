<?php

namespace App\Http\Controllers;

use App\Models\rombel_mapel_guru;
use Illuminate\Http\Request;

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
        if($mapel != null && $mapel->dari >= $request->dari && $mapel->sampai <= $request->sampai) {
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
}
