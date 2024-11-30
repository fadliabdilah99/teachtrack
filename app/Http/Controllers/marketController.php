<?php

namespace App\Http\Controllers;

use App\Models\sellMateri;
use Illuminate\Http\Request;

class marketController extends Controller
{
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
}
