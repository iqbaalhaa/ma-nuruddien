<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Konten berbentuk daftar. Semuanya punya kolom urutan supaya admin bisa
 * mengatur susunan tampil tanpa bergantung pada tanggal atau abjad.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Halaman profil, bagian sejarah
        Schema::create('linimasa', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 20);
            $table->text('peristiwa');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman profil, bagian visi dan misi
        Schema::create('misi', function (Blueprint $table) {
            $table->id();
            $table->text('isi');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman profil, bagan struktur organisasi
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            // 1 kepala madrasah, 2 pembina, 3 wakil kepala, 4 pelaksana
            $table->unsignedTinyInteger('baris')->default(3);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman akademik, jam belajar harian
        Schema::create('jadwal_harian', function (Blueprint $table) {
            $table->id();
            $table->string('waktu', 20);
            $table->string('kegiatan');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman akademik, tiga jalur peminatan
        Schema::create('peminatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 40);               // MIA, IIS, Keagamaan
            $table->string('nama');                   // Matematika & Ilmu Alam
            $table->text('keterangan');
            $table->text('pendalaman')->nullable();   // daftar mata pelajaran inti
            $table->string('ikon')->default('buku');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman akademik, kalender tahun ajaran
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('periode', 60);            // Juli 2025
            $table->string('kegiatan');
            $table->string('keterangan')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman akademik, capaian siswa
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('peringkat', 40);          // Juara 1
            $table->string('judul');
            $table->string('keterangan')->nullable();
            $table->string('tahun', 10);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman fasilitas, sarana belajar
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ringkas');                // baris kecil di bawah nama
            $table->text('keterangan');               // muncul saat kartu diklik
            $table->string('ikon')->default('kelas');
            $table->string('warna')->default('pucuk');
            $table->string('gambar')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman fasilitas, daftar kegiatan
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Halaman fasilitas, galeri kegiatan
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('ringkas');
            $table->text('keterangan');
            $table->string('ikon')->default('bendera');
            $table->string('warna')->default('pucuk');
            $table->string('gambar')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach ([
            'galeri', 'ekstrakurikuler', 'fasilitas', 'prestasi', 'agenda',
            'peminatan', 'jadwal_harian', 'pengurus', 'misi', 'linimasa',
        ] as $tabel) {
            Schema::dropIfExists($tabel);
        }
    }
};
