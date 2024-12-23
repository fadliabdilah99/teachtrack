<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\User;
use Illuminate\Http\Request;

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
}
