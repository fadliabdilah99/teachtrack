<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class apiController extends Controller
{
    // auth proses
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();
        $statusAbsen = Absensi::where('user_id', $user->id)->whereDate('created_at',  date('Y-m-d'))->first();
        // Cek jika user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Siapkan data user untuk response
            $data = [
                'id' => (string) $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'kelas' => $user->rombel->kelas . " " . $user->rombel->jurusan->jurusan . " " . $user->rombel->jurusan->no,
                'status' => $statusAbsen ? 'sudah absen' : 'belum absen',
                // Tambahkan atribut lain jika perlu
            ];

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil.',
                'data' => $data,
            ]);
        }

        // Jika email atau password salah
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.',
        ], 401);
    }


    public function status(Request $request)
    {
        $statusAbsen = Absensi::where('user_id', $request->id_user)->whereDate('created_at',  date('Y-m-d'))->first();

        $data = [
            'status' => $statusAbsen ? 'sudah absen' : 'belum absen',
        ];
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
