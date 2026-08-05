<?php

namespace App\Http\Controllers\Panel;

use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends KontenController
{
    protected string $model = Ekstrakurikuler::class;
    protected string $rute = 'ekstrakurikuler';
    protected string $judul = 'Ekstrakurikuler';
    protected string $satuan = 'kegiatan';
    protected ?string $catatan = 'Tampil sebagai daftar di halaman Fasilitas.';

    protected function medan(): array
    {
        return [
            ['nama' => 'nama', 'label' => 'Nama kegiatan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:80'],
        ];
    }
}
