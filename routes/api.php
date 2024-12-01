<?php

use App\Http\Controllers\paymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('web')->post('/donation', [paymentController::class, 'store']);
Route::post('/notification', [paymentController::class, 'notification']);
