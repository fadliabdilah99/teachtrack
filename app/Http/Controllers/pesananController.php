<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\notification;
use App\Models\pesanan;
use App\Models\wallet;
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

        // memastikan produk yang di checkout dari toko yang sama
        $perbandingan = cart::where('id', $request->cart_items[0])->first();
        $perbandingan = $perbandingan->produk->user_id;
        foreach ($request->cart_items as $check) {
            $cart = cart::where('id', $check)->first();
            if ($perbandingan != $cart->produk->user_id) {
                return redirect()->back()->with('error', 'pesan dari toko yang sama');
            }
        }

        foreach ($request->cart_items as $produk) {
            $cart = cart::where('id', $produk)->first();
            $cart->update([
                'pesanan_id' => $pesanan->id,
                'status' => 'masuk pesanan',
            ]);
        }
        return redirect()->route('pesanan')->with('success', 'pesanan berhasil di checkout');
    }

    public function deleteCart(Request $request)
    {
        foreach ($request->cart_items as $produk) {
            cart::where('id', $produk)->delete();
        }
        return redirect()->route('shop')->with('success', 'Cart di hapus');
    }

    public function index()
    {
        return view('siswa.pesanan.index');
    }

    public function bayar($id)
    {
        $id = $id;
        $pesanans = pesanan::where('id', $id)->where('status', 'pending')->first();
        return view('siswa.pesanan.proses', compact('pesanans', 'id'));
    }

    public function selesai($id)
    {
        $pesanan = pesanan::where('id', $id)->with('cart')->first();
        // mengirimkan dana kepada penjual
        wallet::where('unique', $pesanan->kode)->update([
            'unique' => null
        ]);

        // menghitung total uang masuk
        $nominal = 0;
        foreach ($pesanan->cart as $carts) {
            $nominal += $carts->qty * $carts->produk->harga;
        }
        // dd($nominal);
        $pesanan->update([
            'status' => 'selesai',
            'uang_masuk' => $nominal,
        ]);
        return redirect()->route('pesanan')->with('success', 'pesanan selesai');
    }

    public function batalkan($id)
    {
        $pesanan = pesanan::where('id', $id)->with('cart')->first();
        foreach ($pesanan->cart as $carts) {
            $nominal = $carts->qty * $carts->produk->harga;
        }
        wallet::create([
            'user_id' => Auth::user()->id,
            'nominal' => $nominal,
            'jenis' => 'uang masuk',
            'keterangan' => 'pembatalan pesanan ' . $pesanan->kode,
        ]);
        $pesanan->update([
            'status' => 'refund',
        ]);
        return redirect()->route('pesanan')->with('success', 'pesanan dibatalkan');
    }

    // proses refund pesanan
    public function refund(Request $request)
    {
        $pesanan = pesanan::where('id', $request->id_pesanan)->with('cart')->first();
        if ($pesanan->status == 'payment2') {
            $status = 'refundP';
        } else {
            $status = 'refundC';
        };
        notification::create([
            'user_id' => $pesanan->cart[0]->produk->user_id,
            'title' => 'pesanan Refund',
            'message' => 'pesanan dengan id ' . $pesanan->code . ' mengajukan refund',
            'status' => 'unread',
        ]);
        $pesanan->update([
            'status' => $status,
            'catatan' => $request->alasan,
        ]);
        return redirect()->back()->with('success', 'menunggu konfirmasi penjual');
    }

    // halaman invoice
    public function invoice($id)
    {
        $pesanan = pesanan::where('id', $id)->with('cart')->first();
        return view('siswa.pesanan.invoice', compact('pesanan'));
    }
}
