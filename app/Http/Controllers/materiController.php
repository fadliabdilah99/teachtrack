<?php

namespace App\Http\Controllers;

use App\Models\buyMateri;
use App\Models\diskusi;
use App\Models\guru_mapel;
use App\Models\materi_rombel;
use App\Models\materiGuru;
use App\Models\materiStrukture;
use App\Models\questions;
use App\Models\rombel_mapel_guru;
use App\Models\User;
use App\Models\user_materi_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class materiController extends Controller
{
    public function index()
    {
        $data['materis'] = materiGuru::where('user_id', Auth::user()->id)->with(['buy', 'struktur', 'sell'])->get();
        return view('guru.materi.index')->with($data);
    }



    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
            'guru_mapel_id' => 'required',
        ]);

        materiGuru::create($request->all());
        return redirect()->back()->with('success', 'materi berhasil ditambahkan');
    }

    public function struktur($id)
    {
        if (materiGuru::where('id', $id)->where('user_id', Auth::user()->id)->first() == null) {
            return redirect()->back()->with('error', 'materi ini bukan milikmu');
        }
        $data['materi'] = materiGuru::where('id', $id)->first();
        $data['structure'] = materiStrukture::where('materiGuru_id', $id)->get();
        return view('guru.materi.struktur.main')->with($data);
    }


    public function addstruktur(Request $request)
    {
        $request->validate([
            'materiGuru_id' => 'required',
            'judul' => 'required',
            'subjudul' => 'required',
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,jpg,png,mp4',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $fileName);
            $request->merge(['file' => $fileName]);
        }

        // memanggil data data yang di perlukan untuk menginput progres materi bila ada tambahan materi
        $guru_mapel_id = materiGuru::where('id', $request->materiGuru_id)->first()->id;
        $rombel_mapel = rombel_mapel_guru::where('guru_mapel_id', $guru_mapel_id)->select('rombel_id')->distinct()->get();



        $id = materiStrukture::create([
            'materiGuru_id' => $request->materiGuru_id,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'artikel' => $request->artikel,
            'file' => $request->file,
        ]);

        // mengambil data user yang memiliki rombel yang sama dengan rombel mapel
        foreach ($rombel_mapel as $rombel) {
            $user = User::where('rombel_id', $rombel->rombel_id)->get();
            // menambahkan membagikan materi baru ke seluruh siswa terkait
            foreach ($user as $u) {
                user_materi_guru::create([
                    'user_id' => $u->id,
                    'materiStrukture_id' => $id->id,
                    'materi_guru_id' => $request->materiGuru_id,
                    'progres' => 2,
                ]);
            }
        }


        return redirect()->back()->with('success', 'materi struktur berhasil ditambahkan');
    }


    public function strukturMapel($id)
    {
        if (!(materi_rombel::where('materi_guru_id', $id)->where('rombel_id', Auth::user()->rombel_id)->exists() || buyMateri::where(['materi_guru_id' => $id, 'user_id' => Auth::user()->id])->exists())) {

            return redirect()->back()->with('error', 'materi ini bukan milikmu');
        }


        $materiFirst = user_materi_guru::where('user_id', Auth::id())
            ->where('materi_guru_id', $id)
            ->where('progres', '2')
            ->first();

        $data['materiFirst'] = $materiFirst ? $materiFirst->materiStrukture_id : null;



        $data['materi'] = materiGuru::where('id', $id)->first();
        $data['structure'] = materiStrukture::where('materiGuru_id', $id)->with([
            'materiGuru',
            'diskusi' => function ($query) {
                $query->whereNull('parent');
            },
            'userMateriGuru' => function ($query) {
                $query->where('user_id', Auth::id());
            }
        ])
            ->get();


        return view('siswa.kelas.struktur.main')->with($data);
    }

    // public function ujian($id)
    // {
    //     if (materi_rombel::where('materi_guru_id', $id)->where('rombel_id', Auth::user()->rombel_id)->first() == null) {
    //         return redirect()->back()->with('error', 'materi ini bukan milikmu');
    //     }

    //     $data['materiFirst'] = user_materi_guru::where('user_id', Auth::id())
    //     ->where('materi_guru_id', $id)
    //     ->where('progres', '2')
    //     ->first()->question_id;



    //     $data['materi'] = materiGuru::where('id', $id)->first();
    //     $data['soals'] = questions::where('materi_guru_id', $id)->with('options')->get();
    //     return view('siswa.kelas.ujian.main')->with($data);
    // }

    public function done(Request $request)
    {
        $data = user_materi_guru::where('user_id', Auth::user()->id)->where('materiStrukture_id', $request->materiStrukture_id)->update([
            'progres' => 1
        ]);
        return redirect()->back()->with('success', 'Good Job!! Yuk lanjut');
    }
}
