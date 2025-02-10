<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\skor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class absensiController extends Controller
{

    // api
    public function store(Request $request)
    {
        Log::info($request->all());

        // Validasi data
        $validated = $request->validate([
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            // 'foto' => 'required',
        ]);

        try {
            $latitudeCenter = -6.826727;
            $longitudeCenter = 107.136935;
            $maxDistance = 500; // Maksimal jarak dalam meter

            $distance = DB::select("SELECT (6371000 * ACOS(COS(RADIANS(?)) * COS(RADIANS(?)) * COS(RADIANS(?) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(?)))) AS distance", [
                $latitudeCenter,
                $validated['latitude'],
                $longitudeCenter,
                $validated['longitude'],
                $latitudeCenter,
                $validated['latitude']
            ]);

            $actualDistance = $distance[0]->distance; // Ambil hasil jarak dalam meter

            Log::info("Jarak user: " . $actualDistance . " meter");

            // Jika jarak lebih dari 500 meter, tolak absen
            if ($actualDistance > $maxDistance) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda berada di luar jangkauan absen (lebih dari 500m)',
                    'distance' => $actualDistance . ' meter'
                ], 400);
            }

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

            // Hitung skor berdasarkan waktu masuk
            $waktuMasuk = $absensi->created_at->format('H:i:s');
            if ($waktuMasuk >= '06:00:00' && $waktuMasuk < '06:40:00') {
                $skor = 5;
            } elseif ($waktuMasuk >= '06:40:00' && $waktuMasuk < '07:00:00') {
                $skor = 3;
            } elseif ($waktuMasuk <= '07:00:00') {
                $skor = 1;
            } else {
                $skor = -5;
            }

            // Simpan skor
            Skor::create([
                'user_id' => $validated['user_id'],
                'skor' => $skor,
            ]);

            return response()->json([
                'message' => 'Absensi berhasil disimpan!',
                'data' => $absensi,
                'distance' => $actualDistance . ' meter'
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
