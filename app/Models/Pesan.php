<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Kiriman dari formulir kontak. Hanya dibaca admin, tidak pernah tampil di situs. */
class Pesan extends Model
{
    protected $table = 'pesan';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['dibaca' => 'boolean'];
    }

    public static function jumlahBelumDibaca(): int
    {
        return static::where('dibaca', false)->count();
    }
}
