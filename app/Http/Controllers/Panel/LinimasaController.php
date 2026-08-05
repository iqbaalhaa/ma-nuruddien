<?php

namespace App\Http\Controllers\Panel;

use App\Models\Linimasa;

class LinimasaController extends KontenController
{
    protected string $model = Linimasa::class;
    protected string $rute = 'linimasa';
    protected string $judul = 'Sejarah madrasah';
    protected string $satuan = 'peristiwa';
    protected ?string $catatan = 'Linimasa tahun demi tahun di halaman Profil.';

    protected function medan(): array
    {
        return [
            ['nama' => 'tahun', 'label' => 'Tahun', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:20'],
            ['nama' => 'peristiwa', 'label' => 'Peristiwa', 'jenis' => 'panjang', 'daftar' => true,
                'aturan' => 'required|string|max:400'],
        ];
    }
}
