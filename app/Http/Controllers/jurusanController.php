<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use Illuminate\Http\Request;

class jurusanController extends Controller
{
    public function index(){
        $data['jurusan'] = jurusan::with('rombel')->get();
        return view('admin.jurusan.index')->with($data);
    }
    public function create(Request $request){

        $request->validate([
            'jurusan' => 'required',
        ]);
        jurusan::create($request->all());
        return redirect()->back()->with('success', 'berhasil ditambahkan');
    }
}
