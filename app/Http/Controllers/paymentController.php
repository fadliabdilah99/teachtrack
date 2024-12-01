<?php

namespace App\Http\Controllers;

use App\Models\buyMateri;
use App\Models\chart;
use App\Models\penjualan;
use App\Models\sellMateri;
use App\Models\shop;
use App\Models\size;
use App\Models\so;
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
            $kodeInvoice =  rand(10000, 99999) . time();
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
                        'order_id'      => $donation->kodeInvoice,
                        'gross_amount'  => $request->pembayaran,
                    ],
                    'customer_details' => [
                        'first_name'    => Auth::user()->name,
                        'email'         => Auth::user()->email,
                        // 'phone'         => '08888888888',
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

    // public function notification(Request $request)
    // {
    //     $payload = $request->getContent();
    //     Log::info('Midtrans Notification Received:');
    //     Log::info($payload);

    //     $notification = json_decode($payload);

    //     $transactionStatus = $notification->transaction_status;
    //     $paymentType = $notification->payment_type;
    //     $kodeInvoice = $notification->order_id;
    //     $fraudStatus = $notification->fraud_status;

    //     $barang = penjualan::where('kodeInvoice', $kodeInvoice)->get();

    //     if ($barang->isEmpty()) {
    //         Log::error('Donation with order ID ' . $kodeInvoice . ' not found.');
    //         return response('Donation not found.', 404);
    //     }


    //     foreach ($barang as $paymentrespons) {
    //         // Logika status transaksi
    //         if ($transactionStatus == 'capture' && $paymentType == 'credit_card') {
    //             $paymentrespons->status = ($fraudStatus == 'challenge') ? 'pending' : 'payment';
    //         } elseif ($transactionStatus == 'settlement') {
    //             $paymentrespons->status = 'payment';
    //         } elseif ($transactionStatus == 'pending') {
    //             $paymentrespons->status = 'pending';
    //         } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel') {
    //             $paymentrespons->status = 'failed';
    //         } elseif ($transactionStatus == 'expire') {
    //             $paymentrespons->status = 'expired';
    //         }

    //         $paymentrespons->save();

    //         // Proses pengurangan stok jika sukses
    //         if ($paymentrespons->status == 'payment') {
    //             $cart = chart::where('so_id', $paymentrespons->so_id)->where('user_id', $paymentrespons->user_id)->first();
    //             $shop = shop::where('so_id', $paymentrespons->so_id)->first();

    //             if ($cart && $shop) {
    //                 $size = size::where('shop_id', $shop->id)->where('size', $cart->size)->first();
    //                 if ($size) {
    //                     $size->update(['qty' => $size->qty - $cart->qty]);
    //                 }
    //                 $shop->update(['qty' => $shop->qty - $cart->qty]);
    //                 $cart->delete();
    //             }

    //             // notifikasi ke admin
    //             $sid    = env('TWILIO_SID');
    //             $token  = env('TWILIO_TOKEN');
    //             $twilio = new Client($sid, $token);

    //             $message = $twilio->messages
    //                 ->create(
    //                     "whatsapp:+6281220786387", // to
    //                     array(
    //                         "from" => "whatsapp:+14155238886",
    //                         "body" => 'Ada Pesanan Yang Harus dikirim Nihhhh....!!'
    //                     )
    //                 );
    //         }
    //     }

    //     return response('Notification processed.', 200);
    // }
}
