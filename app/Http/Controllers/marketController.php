<?php

namespace App\Http\Controllers;

use App\Models\buyMateri;
use App\Models\produk;
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
    public function stopsell($id)
    {
        sellMateri::where('materi_guru_id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Di hapus dari market');
    }

    // siswa------------------------------------------------
    public function index()
    {
        $data['barang'] = produk::with(['user'])->inRandomOrder()->limit(20)->get();
        $data['sell'] = sellMateri::with(['materiGuru', 'pembeli'])->inRandomOrder()->limit(10)->get();
        $data['terjual'] = buyMateri::orderBy('created_at', 'desc')->where('status', 'payment')->limit(5)->get();

        return view('siswa.market.index')->with($data);
    }

    public function view($id)
    {
        $data['produks'] = produk::with(['user', 'foto'])->where('id', $id)->first();
        // dd($data['produks']);
        return view('siswa.market.view')->with($data);
    }
}
