<?php

namespace App\Http\Controllers;

use App\Models\fotoProduk;
use App\Models\pesanan;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function pin($id)
    {
        // memastikan hanya 5 produk yang di pin
        $produk = produk::where('user_id', Auth::user()->id)->where('pin', '1')->orderBy('created_at', 'asc')->get();
        if ($produk->count() >= 5) {
            $produk[0]->update(['pin' => '0']);
        }
        if (produk::where('id', $id)->first()->pin != '1') {
            produk::where('id', $id)->update(['pin' => '1']);
        } else {
            produk::where('id', $id)->update(['pin' => '0']);
        }
        return redirect()->back()->with('success', 'Produk berhasil di pin');
    }


}
