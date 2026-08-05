<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'terbit' => 'boolean',
        ];
    }

    public const KATEGORI = [
        'kegiatan' => 'Kegiatan',
        'prestasi' => 'Prestasi',
        'pengumuman' => 'Pengumuman',
    ];

    /** Hanya yang sudah diterbitkan dan tanggalnya tidak di masa depan. */
    public function scopeTayang(Builder $q): Builder
    {
        return $q->where('terbit', true)->whereDate('tanggal', '<=', now());
    }

    public function scopeTerbaru(Builder $q): Builder
    {
        return $q->orderByDesc('tanggal')->orderByDesc('id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function namaKategori(): string
    {
        return self::KATEGORI[$this->kategori] ?? $this->kategori;
    }

    /**
     * Membuat slug yang belum dipakai. Judul berita bisa saja sama persis
     * antar tahun ajaran, jadi bentrokan ditangani dengan menambah angka.
     */
    public static function slugUnik(string $judul, ?int $kecualiId = null): string
    {
        $dasar = Str::slug($judul) ?: 'berita';
        $slug = $dasar;
        $n = 2;

        while (static::where('slug', $slug)
            ->when($kecualiId, fn ($q) => $q->where('id', '!=', $kecualiId))
            ->exists()) {
            $slug = $dasar.'-'.$n++;
        }

        return $slug;
    }
}
