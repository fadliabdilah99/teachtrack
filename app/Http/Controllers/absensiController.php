<?php

namespace App\Http\Controllers;

use App\Models\absensi;
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
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    
}