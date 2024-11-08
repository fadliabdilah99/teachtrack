<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class siswaController extends Controller
{
    public function index()
    {
        return view('siswa.home.index');
    }

    public function addsiswa(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'NoUnik' => 'required',
        ]);


        $user = User::create([
            'rombel_id' => Auth::user()->rombel_id,
            'name' => $request->name,
            'NoUnik' => $request->NoUnik,
            'role' => $request->role,
            'password' => Hash::make('*' . $request->NoUnik),
            'email' => $request->NoUnik . '@gmail.com',
        ]);
        User::create([
            'name' => 'orang tua ' . $request->name,
            'NoUnik' =>  $user->id,
            'role' => 'ortu',
            'password' => Hash::make('*' . $request->NoUnik),
            'email' => 'OT' . $request->NoUnik . '@gmail.com',
        ]);
        return redirect()->back()->with('success', 'berhasil menambahkan Ketua Murid & akun Orang Tua');
    }
}
