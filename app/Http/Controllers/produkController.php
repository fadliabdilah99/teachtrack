<?php

namespace App\Http\Controllers;

use App\Models\fotoProduk;
use App\Models\produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function addproduk(Request $request)
    {

        if ($request->hasFile('foto') == null) {
            return redirect()->back()->with('error', 'Tambahkan Foto Produk minimal 1');
        }
        $produk = $request->validate([
            'user_id' => 'required|integer',
            'judul' => 'required|string|max:255',
            'harga' => 'required|integer',
            'kategori_id' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kode' => 'required|string',
            'stok' => 'required|string',
        ]);
        produk::create($produk);

        foreach ($request->file('foto') as $file) {
            $fileName = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/produk'), $fileName);
            fotoProduk::create([
                'produk_id' => produk::latest()->first()->id,
                'foto' => $fileName,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }
}
