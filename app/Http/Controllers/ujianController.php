<?php

namespace App\Http\Controllers;

use App\Models\materiGuru;
use App\Models\optionQuestion;
use App\Models\questions;
use App\Models\rombel_mapel_guru;
use App\Models\User;
use App\Models\user_materi_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ujianController extends Controller
{
    public function struktur($id)
    {
        if (materiGuru::where('id', $id)->where('user_id', Auth::user()->id)->first() == null) {
            return redirect()->back()->with('error', 'materi ini bukan milikmu');
        }
        $data['materi'] = materiGuru::where('id', $id)->first();
        $data['structure'] = questions::where('materi_guru_id', $id)->with('options')->get();
        return view('guru.materi.ujian.main')->with($data);
    }


    public function addsoal(Request $request)
    {
        $request->validate([
            'materi_guru_id' => 'required',
            'question' => 'required',
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,jpg,png,mp4',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $fileName);
            $request->merge(['file' => $fileName]);
        }
        // memanggil data data yang di perlukan untuk menginput progres materi bila ada tambahan materi
        $guru_mapel_id = materiGuru::where('id', $request->materi_guru_id)->first()->id;
        $rombel_mapel = rombel_mapel_guru::where('guru_mapel_id', $guru_mapel_id)->select('rombel_id')->distinct()->get();
        $id = questions::create([
            'materi_guru_id' => $request->materi_guru_id,
            'question' => $request->question,
            'file' => $request->file,
        ]);

        // mengambil data user yang memiliki rombel yang sama dengan rombel mapel
        foreach ($rombel_mapel as $rombel) {
            $user = User::where('rombel_id', $rombel->rombel_id)->get();
            // menambahkan user ke table user_materi_guru
            foreach ($user as $u) {
                user_materi_guru::create([
                    'user_id' => $u->id,
                    'questions_id' => $id->id,
                    'materi_guru_id' => $request->materiGuru_id,
                    'progres' => 2,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Soal berhasil di tambahkan');
    }

    public function addopsi(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'option' => 'required',
        ]);

        $request->merge(['status' => 'salah']);

        optionQuestion::create($request->all());
        return redirect()->back()->with('success', 'opsi berhasil di tambahkan')->with(['soal_id' => $request->question_id]);
    }

    public function editopsi($id, Request $request)
    {
        $request->validate([
            'status' => 'required',
            'question_id' => 'required',
        ]);

        $soal = optionQuestion::where('id', $id)->first();
        $status = $request->status == 'benar' ? 'salah' : 'benar';
        optionQuestion::where('question_id', $soal->question_id)->update([
            'status' => $status
        ]);

        optionQuestion::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with(['soal_id' => $request->question_id])->with('success', 'opsi berhasil di ubah');
    }
}
