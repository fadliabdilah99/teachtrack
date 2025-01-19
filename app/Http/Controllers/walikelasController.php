<?php

namespace App\Http\Controllers;

use App\Models\skor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class walikelasController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        $data['murid'] = User::where('rombel_id', Auth::user()->rombel_id)
            ->with(['nilai', 'absen' => function ($query) use ($today) {
                $query->where('status', 'hadir')
                    ->whereDate('created_at', $today);
            }])
            ->get();

        // memanggil data yang sudah absen pada hari ini
        $data['kehadiran'] = User::where('rombel_id', Auth::user()->rombel_id)
            ->whereHas('absen', function ($query) use ($today) {
                $query->where('status', 'hadir')
                    ->whereDate('created_at', $today);
            })
            ->with(['nilai', 'absen' => function ($query) use ($today) {
                $query->where('status', 'hadir')
                    ->whereDate('created_at', $today);
            }])
            ->get();

        return view('guru.walikelas.index')->with($data);
    }

    public function skor(Request $request){
        // dd($request->all());
        skor::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambahkan skor');
    }
}
