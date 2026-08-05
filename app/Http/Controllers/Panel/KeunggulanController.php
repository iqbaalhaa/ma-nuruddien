<?php

namespace App\Http\Controllers\Panel;

use App\Models\Keunggulan;

class KeunggulanController extends KontenController
{
    protected string $model = Keunggulan::class;
    protected string $rute = 'keunggulan';
    protected string $judul = 'Keunggulan madrasah';
    protected string $satuan = 'keunggulan';
    protected ?string $catatan = 'Kartu pada bagian "Kenapa memilih kami" di beranda.';

    protected function medan(): array
    {
        return [
            ['nama' => 'judul', 'label' => 'Judul kartu', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:100'],
            ['nama' => 'keterangan', 'label' => 'Keterangan', 'jenis' => 'panjang', 'daftar' => true,
                'aturan' => 'required|string|max:400'],
            ['nama' => 'ikon', 'label' => 'Ikon', 'jenis' => 'ikon', 'aturan' => 'required|string'],
        ];
    }
}
