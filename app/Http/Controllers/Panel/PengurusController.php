<?php

namespace App\Http\Controllers\Panel;

use App\Models\Pengurus;

class PengurusController extends KontenController
{
    protected string $model = Pengurus::class;
    protected string $rute = 'pengurus';
    protected string $judul = 'Struktur organisasi';
    protected string $satuan = 'pengurus';
    protected ?string $catatan = 'Bagan di halaman Profil. Baris menentukan posisi dari atas ke bawah.';

    protected function medan(): array
    {
        return [
            ['nama' => 'nama', 'label' => 'Nama', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:120'],
            ['nama' => 'jabatan', 'label' => 'Jabatan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:120'],
            ['nama' => 'baris', 'label' => 'Baris bagan', 'jenis' => 'pilih', 'daftar' => true,
                'aturan' => 'required|integer|between:1,4',
                'pilihan' => [
                    1 => '1 - Kepala madrasah',
                    2 => '2 - Pembina dan komite',
                    3 => '3 - Wakil kepala',
                    4 => '4 - Pelaksana',
                ]],
        ];
    }
}
