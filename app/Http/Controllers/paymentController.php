<?php

namespace App\Http\Controllers;

use App\Models\buyMateri;
use App\Models\chart;
use App\Models\materiStrukture;
use App\Models\penjualan;
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

        $notification = json_decode($payload);

        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $id = $notification->order_id;
        $fraudStatus = $notification->fraud_status;
        $amout = $notification->gross_amount;
        $parts = explode('-', $id);
        $user_id = $parts[1];

        $pesanan = buyMateri::where('id', $id)->with('materiGuru')->first();


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


        if ($pesanan->status == 'payment') {
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
        }
        return response('Notification processed.', 200);
    }
}
