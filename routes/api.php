<?php

// routes/api.php

use App\Http\Controllers\paymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return ['message' => 'Hello from API'];
});

Route::post('/donation', [paymentController::class, 'store']);
Route::post('/notification', [paymentController::class, 'notification']);
