<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\skor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class absensiController extends Controller
{

    // api
    public function store(Request $request)
    {
        // Debug: Menampilkan data request yang diterima
        Log::info($request->all());

        // Validasi data
        $validated = $request->validate([
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto' => 'required',
        ]);

        try {
            // Debug: Cek apakah foto tersedia
            Log::info('Foto tersedia: ' . $request->hasFile('foto'));

            if ($request->hasFile('foto')) {
                // Menyimpan foto
                $file = $request->file('foto');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file/absensi'), $fileName);
                $fotoPath = 'file/absensi/' . $fileName;
                Log::info('Foto Path: ' . $fotoPath);
            } else {
                throw new \Exception('Foto tidak ditemukan');
            }

            // Menyimpan absensi
            $absensi = Absensi::create([
                'user_id' => $validated['user_id'],
                'latitude' => $validated['latitude'],
                'tanggal' => date('Y-m-d'),
                'waktu_masuk' => date('H:i:s'),
                'longitude' => $validated['longitude'],
                'foto' => $fotoPath,
            ]);

            if ($absensi->created_at->format('H:i:s') >= '06:00:00' && $absensi->created_at->format('H:i:s') < '06:40:00') {
                $skor = 5;
            } elseif ($absensi->created_at->format('H:i:s') >= '06:40:00' && $absensi->created_at->format('H:i:s') < '07:00:00') {
                $skor = 3;
            } elseif ($absensi->created_at->format('H:i:s') <= '07:00:00') {
                $skor = 1;
            } else {
                $skor = -5;
            }

            skor::create([
                'user_id' => $validated['user_id'],
                'skor' => $skor,
            ]);


            return response()->json([
                'message' => 'Absensi berhasil disimpan!',
                'data' => $absensi,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error menyimpan absensi: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan absensi!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // absensi dari sekertaris
    public function absensi(Request $request)
    {
        // dd($request->all());
        $edit = absensi::create([
            'user_id' => Auth::user()->id,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'berhasil menambahkan absensi');
    }
}
