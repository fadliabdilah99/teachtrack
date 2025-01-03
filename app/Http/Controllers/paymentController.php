<?php

namespace App\Http\Controllers;

use App\Models\buyMateri;
use App\Models\cart;
use App\Models\chart;
use App\Models\materiStrukture;
use App\Models\notification;
use App\Models\penjualan;
use App\Models\pesanan;
use App\Models\sellMateri;
use App\Models\shop;
use App\Models\size;
use App\Models\so;
use App\Models\user_materi_guru;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class paymentController extends Controller
{
    protected $response = [];

    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }



    public function store(Request $request)
    {
        try {
            $kodeInvoice =  rand(1000, 9999) . time();
            $selectbuy = sellMateri::where('id', $request->sell_id)->first();

            DB::beginTransaction();
            try {
                $donation = buyMateri::create([
                    'materi_guru_id' => $selectbuy->materi_guru_id,
                    'sell_materi_id' => $selectbuy->id,
                    'user_id' => Auth::user()->id,
                    'kodeInvoice' => $kodeInvoice
                ]);

                $payload = [
                    'transaction_details' => [
                        'order_id'      => $donation->id . '-' . Auth::user()->id,
                        'gross_amount'  => $request->pembayaran,
                    ],
                    'customer_details' => [
                        'first_name'    => Auth::user()->name,
                        'email'         => Auth::user()->email,
                        // 'address'       => '',
                    ],
                    'item_details' => [
                        [
                            'id'       => Auth::user()->name,
                            'price'    => $request->pembayaran,
                            'quantity' => 1,
                            'name'     => ucwords(str_replace('_', ' ', Auth::user()->name))
                        ]
                    ]
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($payload);

                $this->response['snap_token'] = $snapToken;

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->response['error'] = $e->getMessage();
            }
        } catch (\Exception $e) {
            $this->response['error'] = $e->getMessage();
        }

        return response()->json($this->response);
    }

    public function notification(Request $request)
    {
        $payload = $request->getContent();
        Log::info('Midtrans Notification Received:');
        Log::info($payload);
        Log::info('anjay mabar 1');


        $notification = json_decode($payload);

        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $id = $notification->order_id;
        $fraudStatus = $notification->fraud_status;
        $amout = $notification->gross_amount;
        
        if (pesanan::where('kode', $id)->first() != null) {
            $pesanan = pesanan::where('kode', $id)->with('cart')->first();
        } else {
            $pesanan = buyMateri::where('id', $id)->with('materiGuru')->first();
            $parts = explode('-', $id);
            $user_id = $parts[1];
        }

        Log::info('Pesanan:', [$pesanan]);

        Log::info('anjay mabar');

        // Logika status transaksi
        if ($transactionStatus == 'capture' && $paymentType == 'credit_card') {
            $pesanan->status = ($fraudStatus == 'challenge') ? 'pending' : 'payment';
        } elseif ($transactionStatus == 'settlement') {
            $pesanan->status = 'payment';
        } elseif ($transactionStatus == 'pending') {
            $pesanan->status = 'pending';
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel') {
            $pesanan->status = 'failed';
        } elseif ($transactionStatus == 'expire') {
            $pesanan->status = 'expired';
        }

        $pesanan->save();


        if ($pesanan->status == 'payment' && pesanan::where('kode', $id)->first() == null) {
            Log::info('masuk kedalam pembelian pelajaran');
            // notifikasi ke admin
            $sid    = env('TWILIO_SID');
            $token  = env('TWILIO_TOKEN');
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create(
                    "whatsapp:+6281220786387", // to
                    array(
                        "from" => "whatsapp:+14155238886",
                        "body" => 'Anda telah membeli materi selamat belajar'
                    )
                );

            if (wallet::where('keterangan', 'pembelian materi ' . $pesanan->materiGuru->judul)->first() == null) {
                wallet::create([
                    'user_id' => $pesanan->materiGuru->user->id,
                    'nominal' => $amout,
                    'keterangan' => 'pembelian materi ' . $pesanan->materiGuru->judul,
                    'jenis' => 'uang masuk'
                ]);
            }

            $materiStrukture = materiStrukture::where('materiGuru_id', $pesanan->materi_guru_id)->get();

            foreach ($materiStrukture as $strukture) {
                if (user_materi_guru::where('materiStrukture_id', $strukture->id)->first() == null) {
                    user_materi_guru::create([
                        'user_id' => $user_id,
                        'materiStrukture_id' => $strukture->id,
                        'materi_guru_id' => $pesanan->materi_guru_id,
                        'progres' => 2,
                    ]);
                }
            }
        } elseif ($pesanan->status == 'payment' && pesanan::where('kode', $id)->first() != null) {
            Log::info('masuk kedalam pembelian produk');
            // notifikasi ke penjual
            $sid    = env('TWILIO_SID');
            $token  = env('TWILIO_TOKEN');
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create(
                    "whatsapp:+6281220786387", // to
                    array(
                        "from" => "whatsapp:+14155238886",
                        "body" => 'Ada pesanan baru, segera proses pesanan'
                    )
                );
            foreach ($pesanan->cart as $carts) {
                if (wallet::where('keterangan', 'penjualan produk ' . $carts->produk->judul)->first() == null) {
                    $carts->produk->update([
                        'stok' => $carts->produk->stok - $carts->qty
                    ]);
                    wallet::create([
                        'user_id' => $carts->produk->user_id,
                        'nominal' => $amout,
                        'keterangan' => 'penjualan produk ' . $carts->produk->judul,
                        'jenis' => 'uang masuk'
                    ]);
                }
            }
        }
        return response('Notification processed.', 200);
    }

    public function COD($id)
    {
        // mengubah status
        $pesanan = pesanan::where('id', $id)->first();
        $pesanan->update([
            'status' => 'COD',
        ]);

        // mengurangi stok
        $cart = cart::where('pesanan_id', $pesanan->id)->get();
        foreach ($cart as $carts) {
            $carts->produk->update([
                'stok' => $carts->produk->stok - $carts->qty,
            ]);
        }

        // membuat notifikasi
        notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'pesanan anda dengan id ' . $pesanan->code . ' sedang diproses',
            'message' => 'pesanan sudah masuk ke penjual, menunggu di proses oleh penjual',
            'status' => 'unread',
        ]);


        // mengirim notifikasi ke wa penjual
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);
        $message = $twilio->messages
            ->create(
                "whatsapp:+6281220786387", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => 'Ada pesanan masuk, segera proses pesanan'
                )
            );


        return redirect()->route('pesanan')->with('success', 'pesanan anda sedang diproses');
    }


    public function selesai($id)
    {
        $pesanan = pesanan::where('id', $id)->first();
        $pesanan->update([
            'status' => 'selesai',
        ]);
        return redirect()->route('pesanan')->with('success', 'pesanan selesai');
    }


    // payment method
    public function payment(Request $request)
    {
        try {
            // Log untuk melihat request yang masuk

            // Cek data pesanan berdasarkan ID
            $pesanan = pesanan::where('id', $request->pesanan_id)->first();
            if (!$pesanan) {
                return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
            }

            DB::beginTransaction();

            try {
                $payload = [
                    'transaction_details' => [
                        'order_id'      => $pesanan->kode,
                        'gross_amount'  => $request->pembayaran,
                    ],
                    'customer_details' => [
                        'first_name'    => $request->name,
                        'email'         => $request->email,
                    ],
                    'item_details' => [
                        [
                            'id'       => $request->name,
                            'price'    => $request->pembayaran,
                            'quantity' => 1,
                            'name'     => ucwords(str_replace('_', ' ', $request->name,))
                        ]
                    ]
                ];

                // Log payload sebelum diproses

                // Mendapatkan Snap Token dari Midtrans
                $snapToken = \Midtrans\Snap::getSnapToken($payload);

                // Log Snap Token

                $this->response['snap_token'] = $snapToken;

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->response['error'] = $e->getMessage();
            }
        } catch (\Exception $e) {
            $this->response['error'] = $e->getMessage();
        }

        return response()->json($this->response);
    }
}
