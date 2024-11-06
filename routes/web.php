<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;
use App\Livewire\Admin\User;
use App\Livewire\AdminComponent;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


// harus login terlebih dahulu
Route::middleware('auth')->group(function () {
    // auth
});

Route::post('addsiswa', [userController::class, 'addsiswa'])->name('addsiswa');

// hanya admin yang bisa akses
Route::group(['middleware' => ['role:admin']], function () {
    // homepage
    Route::get('admin', [adminController::class, 'index'])->name('admin');

    // user setting
    Route::get('admin/user', [userController::class, 'index'])->name('user');
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:murid']], function () {
    // homepage
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:guru']], function () {
    // homepage

});



require __DIR__ . '/auth.php';
