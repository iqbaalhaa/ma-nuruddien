<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Tiga kartu keunggulan di beranda. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keunggulan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('keterangan');
            $table->string('ikon')->default('buku');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keunggulan');
    }
};
