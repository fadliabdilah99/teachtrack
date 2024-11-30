<?php

namespace App\Http\Controllers;

use App\Models\sellMateri;
use Illuminate\Http\Request;

class marketController extends Controller
{
    // guru------------------------------------------------
    public function jual(Request $request)
    {
        $request->validate([
            'materi_guru_id' => 'required',
        ]);
        sellMateri::create($request->all());
        return redirect()->back()->with('success', 'Berhasil Di Pasarkan');
    }
    public function stopsell($id){
        sellMateri::where('materi_guru_id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Di hapus dari market');
    }

    // siswa------------------------------------------------
    public function index(){
        $data['sell'] = sellMateri::with('materiGuru')->inRandomOrder()->limit(10)->get();
        return view('siswa.market.index')->with($data);
    }
}
