<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kiriman dari pengunjung. Pesan kontak sifatnya pribadi dan hanya dibaca
 * admin. Buku tamu bisa ditampilkan di halaman kontak, tetapi harus disetujui
 * dulu supaya kiriman sembarangan tidak langsung muncul di situs.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('peran')->nullable();
            $table->text('pesan');
            $table->boolean('dibaca')->default(false)->index();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });

        Schema::create('tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('peran')->nullable();
            $table->text('pesan');
            $table->boolean('tampil')->default(false)->index();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tamu');
        Schema::dropIfExists('pesan');
    }
};
