<?php

namespace App\Http\Controllers;

use App\Models\fotoPost;
use App\Models\like;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function like(Post $post, Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah like postingan ini
        $like = like::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'likes_count' => $post->likes()->count()
        ]);
    }

    public function store(Request $request, Post $post)
    {
        // $request->validate([
        //     'komentar' => 'required|string|max:255',
        // ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::user()->id,
            'content' => $request->komentar,
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment,
            'user' => Auth::user(),
        ]);
    }
}
