<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use App\Models\mapel;
use Illuminate\Http\Request;

class mapelController extends Controller
{
    public function index()
    {
        $data['jurusan'] = jurusan::all()->unique('jurusan');
        $data['mapels'] = mapel::get();
        return view('admin.mapel.index')->with($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'pelajaran' => 'required',
            'jenis' => 'required',
        ]);

        mapel::create($request->all());

        return redirect()->back()->with('success', 'pelajaran berhasil ditambahkan');
    }
}
