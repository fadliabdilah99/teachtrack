<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sellerController extends Controller
{
    // admin
    public function adminkategori(){
        $data['kategori'] = kategori::all();
        return view('admin.usaha.index')->with($data);
    }
    public function addkategori(Request $request){
        $validatedData = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        kategori::create($validatedData);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }



    public function index()
    {
        return view('seller.home.index');
    }

    public function keuangan()
    {
        return view('seller.keuangan.index');
    }

    public function profile($id)
    {
        $data['user'] = User::with('seller')->find($id);
        $data['id'] = $id;
        return view('seller.profile.index', $data);
    }

    public function produk()
    {
        $data['kategori'] = kategori::all();
        return view('seller.produk.index')->with($data);
    }
    
    public function title(Request $request){
        // dd($request->all());
        $user = User::where('id', Auth::user()->id)->with('seller')->first();
        $user->seller->update([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success', 'Berhasil mengubah judul');
    }


    public function updatebg(Request $request){
     
        $user = User::where('id', Auth::user()->id)->with('seller')->first();
        if($request->file('pinPict') == null){
            if ($user->seller->pinPict != null) {
                unlink(public_path('file/seller/' . $user->seller->pinPict));
            }
            $user->seller->update([
                'pinPict' => null
            ]);
            return redirect()->back()->with('success', 'Background berhasil dihapus');
        }
        if ($user->seller->pinPict != null) {
            unlink(public_path('file/seller/' . $user->seller->pinPict));
        }

        $fileName = time() . rand(1, 100) . '.' . $request->file('pinPict')->getClientOriginalExtension();
        $request->file('pinPict')->move(public_path('file/seller'), $fileName);

        $user->seller->update([
            'pinPict' => $fileName
        ]);
        return redirect()->back()->with('success', 'Berhasil memasangkan background');
    }


    public function updatesampul(Request $request){
     
        $user = User::where('id', Auth::user()->id)->with('seller')->first();
        if($request->file('sampul') == null){
            if ($user->seller->sampul != null) {
                unlink(public_path('file/seller/' . $user->seller->sampul));
            }
            $user->seller->update([
                'sampul' => null
            ]);
            return redirect()->back()->with('success', 'Background berhasil dihapus');
        }
        if ($user->seller->sampul != null) {
            unlink(public_path('file/seller/' . $user->seller->sampul));
        }

        $fileName = time() . rand(1, 100) . '.' . $request->file('sampul')->getClientOriginalExtension();
        $request->file('sampul')->move(public_path('file/seller'), $fileName);

        $user->seller->update([
            'sampul' => $fileName
        ]);
        return redirect()->back()->with('success', 'Berhasil memasangkan background');
    }
}
