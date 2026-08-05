<?php

namespace App\Http\Controllers\Panel;

use App\Models\Galeri;

class GaleriController extends KontenController
{
    protected string $model = Galeri::class;
    protected string $rute = 'galeri';
    protected string $judul = 'Galeri kegiatan';
    protected string $satuan = 'kegiatan';
    protected ?string $catatan = 'Tampil di halaman Fasilitas, bagian Galeri.';
    protected string $folderGambar = 'galeri';

    protected function medan(): array
    {
        return [
            ['nama' => 'judul', 'label' => 'Nama kegiatan', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:100'],
            ['nama' => 'ringkas', 'label' => 'Baris singkat', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:80'],
            ['nama' => 'keterangan', 'label' => 'Keterangan lengkap', 'jenis' => 'panjang',
                'aturan' => 'required|string|max:600'],
            ['nama' => 'gambar', 'label' => 'Foto', 'jenis' => 'gambar',
                'aturan' => self::ATURAN_GAMBAR,
                'petunjuk' => 'Boleh dikosongkan. Bila kosong, ikon di bawah yang dipakai.'],
            ['nama' => 'ikon', 'label' => 'Ikon', 'jenis' => 'ikon', 'aturan' => 'required|string'],
            ['nama' => 'warna', 'label' => 'Warna kartu', 'jenis' => 'warna', 'aturan' => 'required|string'],
        ];
    }
}
