<?php

namespace App\Http\Controllers\Panel;

use App\Models\Misi;

class MisiController extends KontenController
{
    protected string $model = Misi::class;
    protected string $rute = 'misi';
    protected string $judul = 'Misi madrasah';
    protected string $satuan = 'butir misi';
    protected ?string $catatan = 'Daftar bernomor di halaman Profil. Visi diatur lewat menu Pengaturan situs.';

    protected function medan(): array
    {
        return [
            ['nama' => 'isi', 'label' => 'Butir misi', 'jenis' => 'panjang', 'daftar' => true,
                'aturan' => 'required|string|max:400'],
        ];
    }
}
