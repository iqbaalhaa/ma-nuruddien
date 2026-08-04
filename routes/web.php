<?php

use App\Http\Controllers\HalamanPublikController;
use App\Http\Controllers\Panel\DasborController;
use App\Http\Controllers\Panel\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman publik
|--------------------------------------------------------------------------
*/

Route::get('/', [HalamanPublikController::class, 'beranda'])->name('beranda');
Route::get('/profil', [HalamanPublikController::class, 'profil'])->name('profil');
Route::get('/akademik', [HalamanPublikController::class, 'akademik'])->name('akademik');
Route::get('/fasilitas', [HalamanPublikController::class, 'fasilitas'])->name('fasilitas');
Route::get('/berita', [HalamanPublikController::class, 'berita'])->name('berita');
Route::get('/kontak', [HalamanPublikController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| Panel admin
|--------------------------------------------------------------------------
| Tidak ada rute registrasi. Akun hanya dibuat lewat seeder atau perintah
| artisan, dan formulir masuk hanya bisa dicapai dengan mengetik URL-nya
| langsung karena tidak ditautkan dari halaman publik mana pun.
*/

Route::prefix('panel')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/masuk', [LoginController::class, 'tampilkan'])->name('login');
        Route::post('/masuk', [LoginController::class, 'masuk'])->middleware('throttle:5,1');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DasborController::class, 'indeks'])->name('panel.dasbor');
        Route::post('/keluar', [LoginController::class, 'keluar'])->name('logout');
    });
});
