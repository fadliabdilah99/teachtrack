<?php

namespace App\Http\Controllers;

use App\Models\fotoPost;
use App\Models\post;
use Illuminate\Http\Request;

class sosmedController extends Controller
{
    public function posting(Request $request)
    {

        $request->validate([
            'konten' => 'required',
        ]);

        $poost = post::create([
            'user_id' => $request->user_id,
            'konten' => $request->konten,
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fileName = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file/sosmed'), $fileName);
                fotoPost::create([
                    'post_id' => $poost->id,
                    'foto' => $fileName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'berhasil menambahkan postingan');
    }
}
