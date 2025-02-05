<?php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\diskusiController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\mapelController;
use App\Http\Controllers\marketController;
use App\Http\Controllers\materiController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\profileController as ControllersProfileController;
use App\Http\Controllers\rombelController;
use App\Http\Controllers\sellerController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\sosmedController;
use App\Http\Controllers\ujianController;
use App\Http\Controllers\userController;
use App\Http\Controllers\walikelasController;
use App\Http\Controllers\walletController;
use App\Livewire\Chat;
use App\Livewire\ChatKelas;
use App\Livewire\GuruChat;
use App\Livewire\ReplyGuru;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');






// harus login terlebih dahulu
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
    // profile siswa
    Route::get('siswa/profile/{id}', [ControllersProfileController::class, 'profile'])->name('profile-siswa');

    Route::post('siswa/profile-update', [ControllersProfileController::class, 'updateFoto'])->name('update-profile');

    // profile penjual
    Route::get('seller/profile/{id}', [sellerController::class, 'profile'])->name('profile.seller');

    // auth
    Route::post('user/pengajuan', [userController::class, 'pengajuan'])->name('pengajuan');

    // proses pemesanan
    Route::post('add-to-cart', [pesananController::class, 'addcart'])->name('add-to-cart');
    Route::post('checkout', [pesananController::class, 'checkout'])->name('checkout');
    Route::post('deleteCart', [pesananController::class, 'deleteCart'])->name('deleteCart');
    Route::get('pesanan', [pesananController::class, 'index'])->name('pesanan');
    Route::get('pesanan/bayar/{id}', [pesananController::class, 'bayar'])->name('bayar');
    Route::post('pesanan/refund', [pesananController::class, 'refund'])->name('refund');
    Route::post('pesanan/selesai/{id}', [pesananController::class, 'selesai'])->name('selesai');
    Route::post('pesanan/batalkan/{id}', [pesananController::class, 'batalkan'])->name('batalkan');
    Route::get('pesanan/invoice/{id}', [pesananController::class, 'invoice'])->name('invoice');
    Route::post('pesanan/bayar/COD/{id}', [paymentController::class, 'COD'])->name('COD');

    // wallet
    Route::post('transfer', [walletController::class, 'transfer'])->name('transfer');
    Route::post('tarik', [walletController::class, 'tarik'])->name('tarik-saldo');
    Route::post('bayar/{id}', [walletController::class, 'bayar'])->name('bayar-ZIEwallet');
});


// hanya admin yang bisa akses
Route::group(['middleware' => ['role:admin']], function () {
    // homepage
    Route::get('admin', [adminController::class, 'index'])->name('admin');

    // penjual
    Route::get('admin/seller/kateori', [sellerController::class, 'adminkategori'])->name('admin-kategori');
    Route::post('admin/seller/kategori', [sellerController::class, 'addkategori'])->name('add-kategori');

    // user setting
    Route::get('admin/user', [userController::class, 'index'])->name('user');
    Route::post('admin/addkelas', [kelasController::class, 'addsiswa'])->name('addkelas');
    Route::post('admin/addguru', [guruController::class, 'create'])->name('addguru');

    // rombel
    Route::post('admin/addrombel', [rombelController::class, 'mapelRombel'])->name('addrombelmapel');
    Route::delete('admin/delete/{id}', [rombelController::class, 'deleteJadwal'])->name('delete-jadwal');

    // pengajuan akun seller
    Route::post('admin/seller/konfir', [userController::class, 'konfirseller'])->name('konfirmasi');
    Route::post('admin/seller/tolak', [userController::class, 'tolakseller'])->name('tolak');

    // mapel
    Route::get('admin/mapel', [mapelController::class, 'index'])->name('mapel');
    Route::post('admin/addmapel', [mapelController::class, 'create'])->name('addmapel');
    Route::post('admin/addpengajar', [guruController::class, 'addmapel'])->name('addpengajar');

    // jurusan
    Route::get('admin/jurusan', [jurusanController::class, 'index'])->name('admin-jurusan');
    Route::post('admin/jurusan', [jurusanController::class, 'create'])->name('add-jurusan');
});


// hanya guru yang bisa akses
Route::group(['middleware' => ['role:guru,konseling']], function () {
    // dashboard
    Route::get('guru', [guruController::class, 'index'])->name('guru');
    Route::get('guru/profile', [guruController::class, 'profile'])->name('guru-profile');


    // halaman materi
    Route::get('guru/materi', [materiController::class, 'index'])->name('materi');
    Route::post('guru/addmateri', [materiController::class, 'create'])->name('addmateri');
    Route::get('guru/materi/structure/{id}', [materiController::class, 'struktur'])->name('struktur');
    Route::post('guru/materi/addstruktur', [materiController::class, 'addstruktur'])->name('addstruktur');
    Route::post('guru/materi/edit', [materiController::class, 'editstruktur'])->name('editstruktur');
    Route::delete('guru/materi/deletemateri/{id}', [materiController::class, 'deletemateri'])->name('deletemateri');

    // ujian controller
    Route::get('guru/materi/ujian/{id}', [ujianController::class, 'struktur'])->name('struktur');
    Route::post('guru/materi/ujian/addsoal', [ujianController::class, 'addsoal'])->name('addsoal');
    Route::post('guru/materi/ujian/addopsi', [ujianController::class, 'addopsi'])->name('addopsi');
    Route::post('guru/materi/ujian/change/{id}', [ujianController::class, 'change'])->name('change');
    Route::post('guru/materi/ujian/fixed', [ujianController::class, 'fixed'])->name('fixed');

    // halaman kelas yang di ajar
    Route::get('guru/kelas', [rombelController::class, 'gurumateri'])->name('gurumateri');
    Route::post('guru/kelas/addmateri', [rombelController::class, 'addmateri'])->name('addmaterirombel');

    // jual materi
    Route::post('guru/materi/jual', [marketController::class, 'jual'])->name('jualmateri');
    Route::delete('guru/materi/stopsell/{id}', [marketController::class, 'stopsell'])->name('stopsell');


    // konseling
    // Route::get('konseling', [konselingController::class, 'index'])->name('konseling');
    Route::get('konseling', GuruChat::class)->name('konseling');
    Route::get('konseling/reply/{user}', ReplyGuru::class)->name('reply');

    // walikelas
    Route::get('guru/walikelas', [walikelasController::class, 'index'])->name('walikelas');
    Route::post('guru/walikelas/addskor', [walikelasController::class, 'skor'])->name('skor');

    // wallet
    Route::get('guru/wallet', [walletController::class, 'indexguru'])->name('wallet-guru');
});


// hanya murid yang bisa akses
Route::group(['middleware' => ['role:siswa,KM,sekertaris']], function () {
    // dashboard
    Route::get('siswa', [siswaController::class, 'index'])->name('siswa');
    Route::get('siswa/profile', [siswaController::class, 'profile'])->name('siswa-profile');

    // mail
    Route::get('siswa/mail', [mailController::class, 'mailSiswa'])->name('mailsiswa');

    // kelas
    Route::get('siswa/kelas', [kelasController::class, 'index'])->name('kelas');
    Route::get('siswa/kelas/structure/{id}', [materiController::class, 'strukturMapel'])->name('strukturrombel');
    Route::post('siswa/kelas/structure/done', [materiController::class, 'done'])->name('paham');
    Route::post('siswa/kelas/addsiswa', [siswaController::class, 'addsiswa'])->name('addsiswa');
    Route::post('siswa/kelas/editsiswa', [siswaController::class, 'editsiswa'])->name('editsiswa');

    // ujian
    Route::get('siswa/kelas/ujian/{id}', [ujianController::class, 'ujian'])->name('ujian');
    Route::post('siswa/kelas/ujian/select', [ujianController::class, 'select'])->name('select');
    Route::post('siswa/kelas/ujian/pending', [ujianController::class, 'pending'])->name('pending');
    Route::post('siswa/kelas/ujian/kirim', [ujianController::class, 'done'])->name('kirim-jawaban');

    // diskusi kelas
    Route::post('siswa/kelas/diskusi/', [diskusiController::class, 'create'])->name('diskusi');

    // sosial media
    Route::post('siswa/posting', [sosmedController::class, 'posting'])->name('posting');
    Route::post('/post/{post}/like', [sosmedController::class, 'like'])->name('like');
    Route::post('/comments/{post}', [sosmedController::class, 'store']);

    // shop
    Route::get('shop', [marketController::class, 'index'])->name('shop');
    Route::get('shop/view/{id}', [marketController::class, 'view'])->name('viewshop');
    Route::post('/donation', [paymentController::class, 'store']);

    // bimbingan konseling
    Route::get('konseling/{user}', Chat::class)->name('chat');

    // chat kelas
    Route::get('siswa/chat-kelas', ChatKelas::class)->name('chat-kelas');

    // absensi
    Route::post('siswa/absensi', [absensiController::class, 'absensi'])->name('absensiSekertaris');

    // walleet
    Route::get('siswa/wallet', [walletController::class, 'index'])->name('wallet');
});





// hanya seller yang bisa akses
Route::group(['middleware' => ['role:penjual']], function () {
    // dashboard
    Route::get('seller', [sellerController::class, 'index'])->name('seller');

    // keuangan
    Route::get('seller/keuangan', [sellerController::class, 'keuangan'])->name('keuangan');

    // toko
    Route::get('seller/produk', [sellerController::class, 'produk'])->name('produk');
    Route::post('seller/produk/update/title', [sellerController::class, 'title'])->name('update-title');
    Route::post('seller/produk/update/bgPin', [sellerController::class, 'updatebg'])->name('update-bg-pin');
    Route::post('seller/produk/update/sampul', [sellerController::class, 'updatesampul'])->name('update-sampul');

    // produk
    Route::post('seller/produk/addproduk', [produkController::class, 'addproduk'])->name('addproduk');
    Route::post('seller/produk/pin/{id}', [produkController::class, 'pin'])->name('pin');

    // proses pesanan
    Route::post('seller/proses/{id}', [sellerController::class, 'proses'])->name('proses');
    Route::post('seller/refund/konfirmasi/{id}', [sellerController::class, 'konfirmasiRefund'])->name('refund-konfirmasi');
    Route::post('seller/refund/tolak/{id}', [sellerController::class, 'tolakRefund'])->name('refund-tolak');
});



Route::post('logout', [userController::class, 'destroy'])
    ->name('logout');
require __DIR__ . '/auth.php';
