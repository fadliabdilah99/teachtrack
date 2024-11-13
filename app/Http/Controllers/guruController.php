<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class guruController extends Controller
{
    public function index(){
        return view('guru.home.index');
    }




    // admin ----------------------------------------------------------------------
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'NoUnik' => 'required',
        ]);


        User::create(
            [
                'name' => $request->name,
                'rombel_id' => $request->rombel,
                'NoUnik' => $request->NoUnik,
                'role' => 'guru',
                'password' => Hash::make('*' . $request->NoUnik),
                'email' => $request->NoUnik . '@gmail.com',
            ]
        );
    }

    public function addmapel(Request $request)
    {
        // Validasi input untuk memastikan ID ada di tabel terkait
        $request->validate([
            'mapel_id' => 'required',
            'guru_id' => 'required',
        ]);

        if (guru_mapel::where('mapel_id', $request->mapel_id)->where('user_id', $request->guru_id)->first() != null) {
            return redirect()->back()->with('error', 'guru tersebut sudah terdaftar di mapel ini');
        };

        guru_mapel::create([
            'user_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id
        ]);
        return redirect()->back()->with('success', 'pengajar berhasil ditambahkan');
    }
}
