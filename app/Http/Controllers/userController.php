<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\jurusan;
use App\Models\mapel;
use App\Models\rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class userController extends Controller
{
    public function index()
    {
        $user = User::with(['rombel', 'siswa', 'mapel'])->get();
        $data['jurusan'] = jurusan::get();
        $data['guru'] = $user->where('role', 'guru');
        $data['murid'] = $user->where('role', 'KM');
        $data['total'] = $user->groupBy('rombel_id')->map->count();
        $data['orangtua'] = $user->where('role', 'ortu');
        $data['mapellist'] = guru_mapel::with('mapel', 'user')->get();

        // Ambil semua rombel beserta jadwalnya
        $data['rombels'] = Rombel::with('jadwal.guruMapel.mapel')->get();
        // Kelompokkan jadwal berdasarkan hari
        $data['groupedByHari'] = $data['rombels']->flatMap(function ($rombel) {
            return $rombel->jadwal;
        })->groupBy('hari');
        // dd($data['groupedByHari']);

        return view('admin.user.index')->with($data);
    }



    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
