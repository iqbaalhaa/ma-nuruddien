<?php

namespace App\Http\Controllers\Panel;

use App\Models\Prestasi;

class PrestasiController extends KontenController
{
    protected string $model = Prestasi::class;
    protected string $rute = 'prestasi';
    protected string $judul = 'Prestasi siswa';
    protected string $satuan = 'prestasi';
    protected ?string $catatan = 'Tampil di halaman Akademik, bagian Prestasi.';

    protected function medan(): array
    {
        return [
            ['nama' => 'peringkat', 'label' => 'Peringkat', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:40',
                'petunjuk' => 'Contoh: Juara 1. Juara 1 ditandai warna emas, selainnya perak.'],
            ['nama' => 'judul', 'label' => 'Nama lomba', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:150'],
            ['nama' => 'keterangan', 'label' => 'Keterangan', 'jenis' => 'teks',
                'aturan' => 'nullable|string|max:150',
                'petunjuk' => 'Tingkat atau penyelenggara lomba.'],
            ['nama' => 'tahun', 'label' => 'Tahun', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:10'],
        ];
    }
}
