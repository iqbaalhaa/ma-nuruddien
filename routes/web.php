<?php

use App\Http\Controllers\HalamanPublikController;
use App\Http\Controllers\Panel;
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
Route::get('/berita/{berita:slug}', [HalamanPublikController::class, 'beritaSatu'])->name('berita.baca');
Route::get('/kontak', [HalamanPublikController::class, 'kontak'])->name('kontak');

Route::post('/kontak/pesan', [HalamanPublikController::class, 'kirimPesan'])
    ->middleware('throttle:5,10')->name('kontak.pesan');
Route::post('/kontak/tamu', [HalamanPublikController::class, 'kirimTamu'])
    ->middleware('throttle:5,10')->name('kontak.tamu');

/*
|--------------------------------------------------------------------------
| Panel admin
|--------------------------------------------------------------------------
| Tidak ada rute registrasi. Akun hanya dibuat lewat seeder, dan formulir
| masuk hanya bisa dicapai dengan mengetik URL-nya langsung karena tidak
| ditautkan dari halaman publik mana pun.
*/

Route::prefix('panel')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/masuk', [Panel\LoginController::class, 'tampilkan'])->name('login');
        Route::post('/masuk', [Panel\LoginController::class, 'masuk'])->middleware('throttle:5,1');
    });

    Route::middleware(['auth', 'admin'])->name('panel.')->group(function () {
        Route::get('/', [Panel\DasborController::class, 'indeks'])->name('dasbor');
        Route::post('/keluar', [Panel\LoginController::class, 'keluar'])->name('keluar');

        // ---- Berita ----
        Route::controller(Panel\BeritaController::class)->prefix('berita')->name('berita.')->group(function () {
            Route::get('/', 'indeks')->name('indeks');
            Route::get('/baru', 'buat')->name('buat');
            Route::post('/', 'simpan')->name('simpan');
            Route::get('/{berita}/ubah', 'ubah')->name('ubah');
            Route::put('/{berita}', 'perbarui')->name('perbarui');
            Route::delete('/{berita}', 'hapus')->name('hapus');
            Route::post('/{berita}/terbit', 'alihTerbit')->name('terbit');
        });

        // ---- Konten berbentuk daftar ----
        // Semuanya memakai KontenController, jadi rutenya seragam.
        $konten = [
            'keunggulan' => Panel\KeunggulanController::class,
            'prestasi' => Panel\PrestasiController::class,
            'fasilitas' => Panel\FasilitasController::class,
            'galeri' => Panel\GaleriController::class,
            'ekstrakurikuler' => Panel\EkstrakurikulerController::class,
            'peminatan' => Panel\PeminatanController::class,
            'agenda' => Panel\AgendaController::class,
            'jadwal-harian' => Panel\JadwalHarianController::class,
            'linimasa' => Panel\LinimasaController::class,
            'misi' => Panel\MisiController::class,
            'pengurus' => Panel\PengurusController::class,
        ];

        foreach ($konten as $jalur => $controller) {
            Route::controller($controller)->prefix($jalur)->name($jalur.'.')->group(function () {
                Route::get('/', 'indeks')->name('indeks');
                Route::get('/baru', 'buat')->name('buat');
                Route::post('/', 'simpan')->name('simpan');
                Route::get('/{id}/ubah', 'ubah')->whereNumber('id')->name('ubah');
                Route::put('/{id}', 'perbarui')->whereNumber('id')->name('perbarui');
                Route::delete('/{id}', 'hapus')->whereNumber('id')->name('hapus');
                Route::post('/{id}/geser', 'geser')->whereNumber('id')->name('geser');
            });
        }

        // ---- Pengaturan situs ----
        Route::get('/pengaturan/{grup?}', [Panel\PengaturanController::class, 'indeks'])->name('pengaturan.indeks');
        Route::put('/pengaturan/{grup}', [Panel\PengaturanController::class, 'simpan'])->name('pengaturan.simpan');

        // ---- Akun sendiri ----
        Route::controller(Panel\AkunController::class)->prefix('akun')->name('akun.')->group(function () {
            Route::get('/', 'indeks')->name('indeks');
            Route::put('/', 'perbarui')->name('perbarui');
            Route::put('/sandi', 'gantiSandi')->name('sandi');
        });

        // ---- Kiriman pengunjung ----
        Route::controller(Panel\PesanController::class)->group(function () {
            Route::get('/pesan', 'indeks')->name('pesan.indeks');
            Route::post('/pesan/{pesan}/baca', 'baca')->name('pesan.baca');
            Route::delete('/pesan/{pesan}', 'hapus')->name('pesan.hapus');

            Route::get('/buku-tamu', 'tamu')->name('tamu.indeks');
            Route::post('/buku-tamu/{tamu}/alih', 'tamuAlih')->name('tamu.alih');
            Route::delete('/buku-tamu/{tamu}', 'tamuHapus')->name('tamu.hapus');
        });
    });
});
