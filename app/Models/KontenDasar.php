<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Induk untuk konten berbentuk daftar yang disusun manual oleh admin.
 *
 * Nama tabel ditulis eksplisit di tiap turunan karena Laravel akan menebak
 * bentuk jamak bahasa Inggris, misalnya "beritas" atau "misis", yang tidak
 * cocok dengan penamaan Indonesia yang dipakai di proyek ini.
 */
abstract class KontenDasar extends Model
{
    protected $guarded = [];

    /** Susunan tampil di halaman publik maupun di panel. */
    public function scopeUrut(Builder $q): Builder
    {
        return $q->orderBy('urutan')->orderBy('id');
    }

    /** Nomor urut berikutnya, dipakai saat menambah data baru. */
    public static function urutanBerikutnya(): int
    {
        return (int) static::max('urutan') + 1;
    }
}
