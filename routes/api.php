<?php

// routes/api.php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\apiController;
use App\Http\Controllers\paymentController;
use App\Models\absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return ['message' => 'Hello from API'];
});

// payment
Route::post('/donation', [paymentController::class, 'store']);
Route::post('/notification', [paymentController::class, 'notification']);


// auth
Route::post('user/login', [apiController::class, 'login']);
Route::post('user/status', [apiController::class, 'status']);


Route::post('/absensi', [absensiController::class, 'store']);