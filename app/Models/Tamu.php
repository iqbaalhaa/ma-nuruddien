<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/** Buku tamu. Baru tampil di halaman kontak setelah disetujui admin. */
class Tamu extends Model
{
    protected $table = 'tamu';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['tampil' => 'boolean'];
    }

    public function scopeDisetujui(Builder $q): Builder
    {
        return $q->where('tampil', true);
    }

    public static function jumlahMenunggu(): int
    {
        return static::where('tampil', false)->count();
    }
}
