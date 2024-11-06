<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $user = User::with('rombel')->get();
        $data['rombel'] = rombel::get();
        $data['guru'] = $user->where('role', 'guru');
        $data['murid'] = $user->where('role', 'KM');
        $data['orangtua'] = $user->where('role', 'orangtua');
        return view('admin.user.index')->with($data);
    }

    public function addsiswa(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rombel' => 'required',
            'NoUnik' => 'required',
        ]);


        User::create([
            'kelas' => $request->kelas,
            'rombel_id' => $request->rombel,
            'name' => $request->name,
            'NoUnik' => $request->NoUnik,
            'role' => 'KM',
            'password' => Hash::make('*' . $request->nis    ),
            'email' => $request->NoUnik . '@gmail.com',
        ]);

        return redirect()->back()->with('success', 'berhasil menambahkan Ketua Murid');
    }
}
