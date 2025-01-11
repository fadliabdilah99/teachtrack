<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class walletController extends Controller
{
    public function index()
    {
        return view('siswa.wallet.index');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'user_id' => 'required',
            'keterangan' => 'required',
        ]);

       $user = User::where('NoUnik', $request->user_id)->first();

       if ($user == null) {
        return redirect()->back()->with('error', 'user tidak ditemukan');
       }

        wallet::create([
            'user_id' => $user->id,
            'nominal' => $request->nominal,
            'jenis' => 'uang masuk',
            'keterangan' => $request->keterangan,
        ]);

        wallet::create([
            'user_id' => Auth::user()->id,
            'nominal' => $request->nominal,
            'jenis' => 'uang keluar',
            'keterangan' => 'transfer ke ' . $user->NoUnik,
        ]);

        return redirect()->back()->with('success', 'Transfer berhasil');

    }



}
