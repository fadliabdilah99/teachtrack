<?php

namespace App\Http\Controllers;

use App\Models\notification;
use App\Models\pesanan;
use App\Models\User;
use App\Models\wallet;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class walletController extends Controller
{
    public function index()
    {
        return view('siswa.wallet.index');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'user_id' => 'required',
            'keterangan' => 'required',
        ]);

        $user = User::where('NoUnik', $request->user_id)->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'user tidak ditemukan');
        }

        wallet::create([
            'user_id' => $user->id,
            'nominal' => $request->nominal,
            'jenis' => 'uang masuk',
            'keterangan' => $request->keterangan,
        ]);

        wallet::create([
            'user_id' => Auth::user()->id,
            'nominal' => $request->nominal,
            'jenis' => 'uang keluar',
            'keterangan' => 'transfer ke ' . $user->NoUnik,
        ]);

        return redirect()->back()->with('success', 'Transfer berhasil');
    }

    public function indexguru()
    {
        return view('guru.wallet.index');
    }



    public function tarik(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'bank' => 'required',
            'nama' => 'required',
            'noRek' => 'required',
        ]);

        $wallet = wallet::where('user_id', Auth::user()->id)->where('jenis', 'uang masuk')->sum('nominal') - wallet::where('user_id', Auth::user()->id)->where('jenis', 'uang keluar')->sum('nominal');

        if ($wallet <= $request->nominal) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi');
        }

        wallet::create([
            'user_id' => Auth::user()->id,
            'nominal' => $request->nominal,
            'keterangan' => 'tarik saldo-' . $request->bank . '-' . $request->noRek . '-' . $request->nama,
            'jenis' => 'uang keluar',
            'unique' => Auth::user()->id . date('YmdHis'),
        ]);

        return redirect()->back()->with('success', 'Tarik saldo berhasil');
    }

    public function bayar($id)
    {
        $pesanan = pesanan::where('id', $id)->with('cart')->first();
        $nominal = 0;
        foreach ($pesanan->cart as $carts) {
            $carts->produk->update([
                'stok' => $carts->produk->stok - $carts->qty
            ]);
            $nominal += $carts->qty * $carts->produk->harga;
        }
        wallet::create([
            'user_id' => Auth::user()->id,
            'nominal' => $nominal,
            'jenis' => 'uang keluar',
            'keterangan' => 'pembayaran pesanan ' . $pesanan->code,
        ]);

        $pesanan->update([
            'status' => 'payment',
        ]);

        notification::create([
            'user_id' => $pesanan->cart[0]->produk->user_id,
            'title' => 'Pembayaran Berhasil',
            'message' => 'pesanan dengan kode ' . $pesanan->code,
            'status' => 'unread',
        ]);

        notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'Pembayaran Berhasil',
            'message' => 'pesanan dengan kode ' . $pesanan->code,
            'status' => 'unread',
        ]);


        return redirect('pesanan')->with('success', 'Pembayaran Berhasil');
    }
}
