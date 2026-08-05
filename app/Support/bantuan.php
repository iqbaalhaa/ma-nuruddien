<?php

use App\Models\Pengaturan;
use Illuminate\Support\HtmlString;

if (! function_exists('pengaturan')) {
    /**
     * Mengambil satu teks pengaturan situs.
     * Nilai bawaan dipakai bila kolomnya belum diisi admin, jadi halaman tidak
     * pernah menampilkan bagian kosong.
     */
    function pengaturan(string $kunci, ?string $bawaan = null): ?string
    {
        return Pengaturan::ambil($kunci, $bawaan);
    }
}

if (! function_exists('sorotan')) {
    /**
     * Mengubah kata yang diapit tanda bintang jadi teks bersorot.
     * Dipakai pada judul hero supaya admin bisa menentukan kata mana yang
     * diberi warna emas tanpa perlu menulis HTML.
     */
    function sorotan(?string $teks): HtmlString
    {
        $aman = e($teks ?? '');
        $hasil = preg_replace('~\*(.+?)\*~u', '<em>$1</em>', $aman);

        return new HtmlString($hasil);
    }
}

if (! function_exists('paragraf')) {
    /**
     * Mengubah teks biasa jadi beberapa paragraf.
     * Baris kosong memisahkan paragraf, satu enter jadi baris baru biasa.
     * Isinya di-escape dulu supaya kiriman dari panel tidak bisa menyisipkan HTML.
     */
    function paragraf(?string $teks): HtmlString
    {
        $blok = preg_split('~\R{2,}~u', trim((string) $teks)) ?: [];

        $hasil = collect($blok)
            ->filter(fn ($p) => trim($p) !== '')
            ->map(fn ($p) => '<p>'.nl2br(e(trim($p))).'</p>')
            ->implode("\n");

        return new HtmlString($hasil);
    }
}
