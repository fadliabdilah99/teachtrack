<?php

namespace App\Http\Controllers;

use App\Models\diskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class diskusiController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'content' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/diskusi'), $fileName);
        } else {
            $fileName = null;
        }




        diskusi::create([
            'content' => $request->content,
            'file' => $fileName,
            'parent' => $request->parent_id,
            'user_id' => Auth::user()->id,
            'rombel_id' => $request->rombel_id,
            'materiStrukture_id' => $request->materiStrukture_id,
        ]);

        return redirect()->back()->withInput()->with('success', 'berhasil menambahkan diskusi')->with(['materi_id' => $request->materiStrukture_id]);
    }
}
