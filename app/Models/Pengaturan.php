<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $guarded = [];

    public const KUNCI_CACHE = 'pengaturan.semua';

    /**
     * Seluruh pengaturan sebagai pasangan kunci dan nilai.
     * Disimpan di cache karena halaman publik memanggilnya berkali-kali.
     */
    public static function semua(): array
    {
        return Cache::rememberForever(self::KUNCI_CACHE, function () {
            return static::pluck('nilai', 'kunci')->all();
        });
    }

    public static function ambil(string $kunci, ?string $bawaan = null): ?string
    {
        $nilai = self::semua()[$kunci] ?? null;

        return ($nilai === null || $nilai === '') ? $bawaan : $nilai;
    }

    public static function lupakanCache(): void
    {
        Cache::forget(self::KUNCI_CACHE);
    }

    protected static function booted(): void
    {
        static::saved(fn () => self::lupakanCache());
        static::deleted(fn () => self::lupakanCache());
    }
}
