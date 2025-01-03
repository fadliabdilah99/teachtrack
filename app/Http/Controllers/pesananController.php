<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class pesananController extends Controller
{
    public function addcart(Request $request)
    {
        cart::create([
            'user_id' => Auth::user()->id,
            'produk_id' => $request->produk_id,
            'qty' => $request->qty,
        ]);
        return redirect()->back()->with('success', 'produk ditambahkan ke keranjang');
    }
    public function checkout(Request $request)
    {
        $pesanan = pesanan::create([
            'kode' => Auth::user()->id . rand(1000, 9999),
            'user_id' => Auth::user()->id,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan,
        ]);
        foreach ($request->cart_items as $produk) {
            $cart = cart::where('id', $produk)->first();
            $cart->update([
                'pesanan_id' => $pesanan->id,
                'status' => 'masuk pesanan',
            ]);
        }
        return redirect()->route('pesanan')->with('success', 'pesanan berhasil di checkout');
    }

    public function index(){
        return view('siswa.pesanan.index');
    }

    public function bayar($id){
        $id = $id;
        $pesanans = pesanan::where('id', $id)->where('status', 'pending')->first();
        return view('siswa.pesanan.proses', compact('pesanans', 'id'));
    }
}
