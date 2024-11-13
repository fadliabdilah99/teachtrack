<?php

namespace App\Http\Controllers;

use App\Models\materiGuru;
use App\Models\materiStrukture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class materiController extends Controller
{
    public function index()
    {
        $data['materis'] = materiGuru::where('user_id', Auth::user()->id)->with('struktur')->get();
        return view('guru.materi.index')->with($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
        ]);

        materiGuru::create($request->all());
        return redirect()->back()->with('success', 'materi berhasil ditambahkan');
    }

    public function addstruktur(Request $request)
    {

        $data['materi'] = materiGuru::where('id', $request->struktur_id)->first();
        $data['structure'] = materiStrukture::where('materiGuru_id', $request->struktur_id)->get();
        return view('guru.materi.struktur.main')->with($data);
    }
}
