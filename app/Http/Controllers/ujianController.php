<?php

namespace App\Http\Controllers;

use App\Models\materi_rombel;
use App\Models\materiGuru;
use App\Models\materiStrukture;
use App\Models\nilai;
use App\Models\optionQuestion;
use App\Models\questions;
use App\Models\rombel_mapel_guru;
use App\Models\User;
use App\Models\user_materi_guru;
use App\Models\user_select_option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $id = questions::create([
            'materi_guru_id' => $request->materi_guru_id,
            'question' => $request->question,
            'file' => $request->file,
        ]);
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


    public function change($id, Request $request)
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

    public function fixed(Request $request)
    {
        materiGuru::where('id', $request->materi_id)->update([
            'jenis' => 'ujian(fixed)',
        ]);
        return redirect()->route('materi')->with('success', 'Ujian selesai Di buat');
    }


    // siswa--------------------------------------------------------------  



    public function ujian($id)
    {
        if (materi_rombel::where('materi_guru_id', $id)->where('rombel_id', Auth::user()->rombel_id)->first() == null) {
            return redirect()->back()->with('error', 'materi ini bukan milikmu');
        }

        $materi = user_materi_guru::where('user_id', Auth::id())
            ->where('materi_guru_id', $id)
            ->where('progres', '2')
            ->first();

        if ($materi != null) {
            $data['materiFirst'] = $materi->question_id;
        } else {
            $data['materiFirst'] = null;
            $data['allAnswered'] = true;
        }

        $data['totalPertanyaan'] = user_materi_guru::where('materi_guru_id', $id)
            ->where('user_id', Auth::id())
            ->count();

        $totalBenar = 0;
        $userMateriGurus = user_materi_guru::where('materi_guru_id', $id)
            ->where('user_id', Auth::id())
            ->get();
        foreach ($userMateriGurus as $userMateriGuru) {
            $userSelectOption = user_select_option::where('user_materi_guru_id', $userMateriGuru->id)->first();
            if ($userSelectOption->option->status == 'benar') {
                $totalBenar++;
            }
        }
        $data['totalBenar'] = $totalBenar;


        $data['nilai'] = $data['totalPertanyaan'] > 0 ? ($data['totalBenar'] / $data['totalPertanyaan']) * 100 : 0;

        $nilai = nilai::where('user_id', Auth::id())->where('materi_guru_id', $id)->first();

        if ($nilai != null) {
            $nilai->update([
                'nilai' => $data['nilai'],
            ]);
        } else {
            nilai::create([
                'user_id' => Auth::id(),
                'materi_guru_id' => $id,
                'nilai' => $data['nilai'],
            ]);
        }


        $data['materi'] = materiGuru::where('id', $id)->first();
        $data['soals'] = questions::where('materi_guru_id', $id)->with('options')->with(['userMateri' => function ($query) {
            $query->where('user_id', Auth::user()->id);
        }])->get();
        return view('siswa.kelas.ujian.main')->with($data);
    }


    // memilih jawaban
    public function select(Request $request)
    {
        $opsidipilih = optionQuestion::where('id', $request->option)->first();
        $user_materi_guru = user_materi_guru::where('user_id', Auth::id())->where('question_id', $opsidipilih->question_id)->first();
        $userSelect = user_select_option::where('question_id', $opsidipilih->question_id)->where('user_materi_guru_id', $user_materi_guru->id)->first();

        if ($userSelect == null) {
            user_select_option::create([
                'user_materi_guru_id' => $user_materi_guru->id,
                'question_id' => $opsidipilih->question_id,
                'option_id' => $opsidipilih->id,
            ]);
        } else {
            $userSelect->update([
                'option_id' => $request->option,
            ]);
        }

        $user_materi_guru->update([
            'progres' => 1
        ]);

        return redirect()->back();
    }

    // pandding jawaban
    public function pending(Request $request)
    {
        $data = user_materi_guru::where('user_id', Auth::user()->id)->where('question_id', $request->option)->update([
            'progres' => 1
        ]);
    }

    public function done(Request $request)
    {
        user_materi_guru::where('user_id', Auth::user()->id)->where('materi_guru_id', $request->materi_id)->update([
            'progres' => 100,
        ]);
    }
}
