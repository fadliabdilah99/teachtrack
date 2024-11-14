<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\mapelController;
use App\Http\Controllers\materiController;
use App\Http\Controllers\rombelController;
use App\Http\Controllers\siswa;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\userController;
use App\Livewire\Admin\User;
use App\Livewire\AdminComponent;
use App\Models\materiGuru;
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
    Route::post('admin/addkelas', [kelasController::class, 'addsiswa'])->name('addkelas');
    Route::post('admin/addguru', [guruController::class, 'create'])->name('addguru');

    // rombel
    Route::post('admin/addrombel', [rombelController::class, 'mapelRombel'])->name('addrombelmapel');

    // mapel
    Route::get('admin/mapel', [mapelController::class, 'index'])->name('mapel');
    Route::post('admin/addmapel', [mapelController::class, 'create'])->name('addmapel');
    Route::post('admin/addpengajar', [guruController::class, 'addmapel'])->name('addpengajar');
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:guru']], function () {
    // dashboard
    Route::get('guru', [guruController::class, 'index'])->name('guru');

    // halaman materi
    Route::get('guru/materi', [materiController::class, 'index'])->name('materi');
    Route::get('guru/materi/kelas', [materiController::class, 'gurumateri'])->name('gurumateri');
    Route::post('guru/addmateri', [materiController::class, 'create'])->name('addmateri');
    Route::get('guru/materi/structure/{id}', [materiController::class, 'struktur'])->name('struktur');
    Route::post('guru/materi/addstruktur', [materiController::class, 'addstruktur'])->name('addstruktur');
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:siswa,KM']], function () {
    // dashboard
    Route::get('siswa', [siswaController::class, 'index'])->name('siswa');

    // kelas
    Route::get('siswa/kelas', [kelasController::class, 'index'])->name('kelas');
    Route::post('addsiswa', [siswaController::class, 'addsiswa'])->name('addsiswa');
});





Route::post('logout', [userController::class, 'destroy'])
    ->name('logout');
require __DIR__ . '/auth.php';
