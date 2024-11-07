<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\siswa;
use App\Http\Controllers\siswaController;
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


// hanya admin yang bisa akses
Route::group(['middleware' => ['role:admin']], function () {
    // homepage
    Route::get('admin', [adminController::class, 'index'])->name('admin');
    
    // user setting
    Route::get('admin/user', [userController::class, 'index'])->name('user');
    Route::post('addsiswa', [userController::class, 'addsiswa'])->name('addsiswa');
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:murid']], function () {
    // homepage
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:siswa,KM']], function () {
    Route::get('siswa', [siswaController::class, 'index'])->name('siswa');
});





Route::post('logout', [userController::class, 'destroy'])
    ->name('logout');
require __DIR__ . '/auth.php';
