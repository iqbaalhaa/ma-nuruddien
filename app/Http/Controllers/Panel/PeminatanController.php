<?php

namespace App\Http\Controllers\Panel;

use App\Models\Peminatan;

class PeminatanController extends KontenController
{
    protected string $model = Peminatan::class;
    protected string $rute = 'peminatan';
    protected string $judul = 'Peminatan';
    protected string $satuan = 'peminatan';
    protected ?string $catatan = 'Jalur yang bisa dipilih siswa. Tampil di halaman Akademik.';

    protected function medan(): array
    {
        return [
            ['nama' => 'kode', 'label' => 'Kode', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:40',
                'petunjuk' => 'Singkatan yang jadi judul kartu, contoh: MIA.'],
            ['nama' => 'nama', 'label' => 'Kepanjangan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:120'],
            ['nama' => 'keterangan', 'label' => 'Keterangan', 'jenis' => 'panjang',
                'aturan' => 'required|string|max:400'],
            ['nama' => 'pendalaman', 'label' => 'Mata pelajaran inti', 'jenis' => 'panjang',
                'aturan' => 'nullable|string|max:300'],
            ['nama' => 'ikon', 'label' => 'Ikon', 'jenis' => 'ikon', 'aturan' => 'required|string'],
        ];
    }
}
