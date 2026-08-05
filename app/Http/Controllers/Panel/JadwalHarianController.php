<?php

namespace App\Http\Controllers\Panel;

use App\Models\JadwalHarian;

class JadwalHarianController extends KontenController
{
    protected string $model = JadwalHarian::class;
    protected string $rute = 'jadwal-harian';
    protected string $judul = 'Jam belajar harian';
    protected string $satuan = 'jam belajar';
    protected ?string $catatan = 'Kotak Jam belajar di halaman Akademik.';

    protected function medan(): array
    {
        return [
            ['nama' => 'waktu', 'label' => 'Jam', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:20', 'petunjuk' => 'Contoh: 06.50'],
            ['nama' => 'kegiatan', 'label' => 'Kegiatan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:120'],
        ];
    }
}
