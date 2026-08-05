<?php

namespace App\Http\Controllers\Panel;

use App\Models\Agenda;

class AgendaController extends KontenController
{
    protected string $model = Agenda::class;
    protected string $rute = 'agenda';
    protected string $judul = 'Kalender akademik';
    protected string $satuan = 'agenda';
    protected ?string $catatan = 'Tabel agenda tahun ajaran di halaman Akademik.';

    protected function medan(): array
    {
        return [
            ['nama' => 'periode', 'label' => 'Bulan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:60', 'petunjuk' => 'Contoh: Juli 2025.'],
            ['nama' => 'kegiatan', 'label' => 'Kegiatan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:150'],
            ['nama' => 'keterangan', 'label' => 'Keterangan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'nullable|string|max:150'],
        ];
    }
}
