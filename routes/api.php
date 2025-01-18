<?php

// routes/api.php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\apiController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\walletController;
use App\Models\absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return ['message' => 'Hello from API'];
});

// payment materi
Route::post('/donation', [paymentController::class, 'store']);
Route::post('/notification', [paymentController::class, 'notification']);

// payment shop
Route::post('/payment', [paymentController::class, 'payment']);

// TopUp
Route::post('/topup', [paymentController::class, 'topup']);

// auth
Route::post('user/login', [apiController::class, 'login']);
Route::post('user/status', [apiController::class, 'status']);


Route::post('/absensi', [absensiController::class, 'store']);

// wallet
Route::post('/wallet/saldo', [apiController::class, 'saldo']);
Route::post('/wallet/pengeluaran', [apiController::class, 'pengeluaran']);
Route::post('/wallet/pemasukan', [apiController::class, 'pemasukan']);
Route::post('/wallet/history', [apiController::class, 'history']);
Route::post('/wallet/transfer', [apiController::class, 'transfer']);
Route::post('/wallet/kuetansi', [apiController::class, 'kuetansi']);