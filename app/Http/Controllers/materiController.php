<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\materi_rombel;
use App\Models\materiGuru;
use App\Models\materiStrukture;
use App\Models\rombel_mapel_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class materiController extends Controller
{
    public function index()
    {
        $data['materis'] = materiGuru::where('user_id', Auth::user()->id)->with('struktur')->get();
        return view('guru.materi.index')->with($data);
    }

   

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
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

        materiStrukture::create([
            'materiGuru_id' => $request->materiGuru_id,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'artikel' => $request->artikel,
            'file' => $fileName,
        ]);



        return redirect()->back()->with('success', 'materi struktur berhasil ditambahkan');
    }


    public function strukturMapel($id){
        if (materi_rombel::where('materi_guru_id', $id)->where('rombel_id', Auth::user()->rombel_id)->first() == null) {
            return redirect()->back()->with('error', 'materi ini bukan milikmu');
        }
        $data['materi'] = materiGuru::where('id', $id)->first();
        $data['structure'] = materiStrukture::where('materiGuru_id', $id)->get();
        return view('siswa.kelas.struktur.main')->with($data);
    }
}
