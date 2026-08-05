<?php

namespace App\Http\Controllers\Panel;

use App\Models\Fasilitas;

class FasilitasController extends KontenController
{
    protected string $model = Fasilitas::class;
    protected string $rute = 'fasilitas';
    protected string $judul = 'Sarana belajar';
    protected string $satuan = 'fasilitas';
    protected ?string $catatan = 'Tampil di halaman Fasilitas. Keterangan muncul saat kartunya diklik pengunjung.';
    protected string $folderGambar = 'fasilitas';

    protected function medan(): array
    {
        return [
            ['nama' => 'nama', 'label' => 'Nama fasilitas', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:100'],
            ['nama' => 'ringkas', 'label' => 'Baris singkat', 'jenis' => 'teks', 'daftar' => true,
                'aturan' => 'required|string|max:80',
                'petunjuk' => 'Satu baris kecil di bawah nama, contoh: 12 rombongan belajar.'],
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
