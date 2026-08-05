<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Teks tunggal yang tersebar di seluruh situs: judul hero, visi, sambutan
 * kepala madrasah, alamat, angka statistik, dan sejenisnya. Disimpan sebagai
 * pasangan kunci dan nilai supaya menambah satu kolom teks baru tidak perlu
 * migrasi lagi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique();
            $table->text('nilai')->nullable();
            $table->string('grup')->index();          // umum, hero, profil, akademik, kontak, statistik
            $table->string('label');                  // judul kolom di panel
            $table->string('jenis')->default('teks'); // teks, panjang, angka, gambar
            $table->string('petunjuk')->nullable();   // keterangan kecil di bawah kolom
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
