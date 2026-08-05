<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->index();        // kegiatan, prestasi, pengumuman
            $table->text('ringkasan');
            $table->longText('isi');
            $table->string('gambar')->nullable();       // relatif terhadap public/unggahan
            $table->string('ikon')->default('wisuda');  // dipakai bila belum ada foto
            $table->string('warna')->default('pucuk');  // pucuk, emas, tanah
            $table->date('tanggal')->index();
            $table->boolean('terbit')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
