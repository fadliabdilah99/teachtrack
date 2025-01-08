<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    // profile
    public function profile($id)
    {
        $data['user'] = User::find($id);
        $data['id'] = $id;
        return view('siswa.profile.index')->with($data);
    }

    public function updateFoto(Request $request)
    {
        if ($request->foto == null) {
            return redirect()->back();
        }
        $user = User::find(Auth::user()->id);
        if ($user->fotoProfile != null) {
            unlink(public_path('file/profile/' . $user->fotoProfile));
        }
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/profile'), $fileName);
            $request->merge(['fotoProfile' => $fileName]);
        }

        $user->update([
            'fotoProfile' => $fileName
        ]);
        return redirect()->back();
    }
}
