<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
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
        $user = User::with(['rombel', 'siswa'])->get();
        $data['jurusan'] = jurusan::get();
        $data['guru'] = $user->where('role', 'guru');
        $data['murid'] = $user->where('role', 'KM');
        $data['total'] = $user->groupBy('rombel_id')->map->count();
        $data['orangtua'] = $user->where('role', 'ortu');
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
