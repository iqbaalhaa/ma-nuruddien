<?php

/*
|--------------------------------------------------------------------------
| Pustaka ikon
|--------------------------------------------------------------------------
|
| Halaman publik memakai ikon garis yang digambar langsung sebagai SVG.
| Daftar ini dipakai panel admin untuk menyediakan pilihan ikon, dan dipakai
| komponen <x-ikon> untuk menggambarnya. Isi tiap entri adalah bagian dalam
| tag <svg> dengan viewBox 0 0 24 24.
|
| Menambah ikon baru cukup dengan menambah satu entri di sini.
|
*/

return [

    'kelas' => [
        'label' => 'Ruang kelas',
        'jalur' => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M7 20h10M9 16v4M15 16v4"/>',
    ],

    'laboratorium' => [
        'label' => 'Laboratorium IPA',
        'jalur' => '<path d="M9 3h6M10 3v6.5L5 19a2 2 0 0 0 1.8 3h10.4A2 2 0 0 0 19 19l-5-9.5V3"/><path d="M7.5 15h9"/>',
    ],

    'komputer' => [
        'label' => 'Komputer',
        'jalur' => '<rect x="2.5" y="4" width="19" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>',
    ],

    'perpustakaan' => [
        'label' => 'Perpustakaan',
        'jalur' => '<path d="M4 5a2 2 0 0 1 2-2h5v18H6a2 2 0 0 0-2 2z"/><path d="M20 5a2 2 0 0 0-2-2h-5v18h5a2 2 0 0 1 2 2z"/>',
    ],

    'musala' => [
        'label' => 'Musala',
        'jalur' => '<path d="M12 2c3.5 3.2 5 5.9 5 8.5V19H7v-8.5C7 7.9 8.5 5.2 12 2Z"/><path d="M4 22h16M12 10.5v8.5"/>',
    ],

    'lapangan' => [
        'label' => 'Lapangan',
        'jalur' => '<rect x="2.5" y="5" width="19" height="14" rx="2"/><path d="M12 5v14M2.5 9.5h3v5h-3M21.5 9.5h-3v5h3"/><circle cx="12" cy="12" r="2.5"/>',
    ],

    'gedung' => [
        'label' => 'Gedung / kantor',
        'jalur' => '<path d="M3 21V8l9-5 9 5v13"/><rect x="9" y="13" width="6" height="8"/><path d="M7 10h2M15 10h2"/>',
    ],

    'kesehatan' => [
        'label' => 'Kesehatan / UKS',
        'jalur' => '<rect x="3" y="6" width="18" height="14" rx="3"/><path d="M12 10v6M9 13h6M8 6V4h8v2"/>',
    ],

    'bendera' => [
        'label' => 'Bendera / upacara',
        'jalur' => '<path d="M6 22V3M6 4h12l-3 4 3 4H6"/>',
    ],

    'bulan-sabit' => [
        'label' => 'Bulan sabit / hari besar Islam',
        'jalur' => '<path d="M20 15.5A8.5 8.5 0 1 1 11 3a7 7 0 0 0 9 12.5Z"/>',
    ],

    'praktikum' => [
        'label' => 'Praktikum',
        'jalur' => '<circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M18.4 5.6l-2.1 2.1M7.7 16.3l-2.1 2.1"/>',
    ],

    'buku' => [
        'label' => 'Buku / kurikulum',
        'jalur' => '<path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v17H6.5A2.5 2.5 0 0 0 4 21.5z"/><path d="M8 7h8M8 11h6"/>',
    ],

    'piala' => [
        'label' => 'Piala / prestasi',
        'jalur' => '<circle cx="12" cy="9" r="6"/><path d="M8.5 14 7 22l5-2.5L17 22l-1.5-8"/>',
    ],

    'guru' => [
        'label' => 'Guru bersertifikasi',
        'jalur' => '<path d="M16 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9.5" cy="7" r="3.5"/><path d="M17 11.5 19 13.5 23 9.5"/>',
    ],

    'kalender' => [
        'label' => 'Kalender / pengumuman',
        'jalur' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/>',
    ],

    'wisuda' => [
        'label' => 'Wisuda / kegiatan',
        'jalur' => '<path d="M3 8l9-4 9 4-9 4z"/><path d="M7 10.5V15c0 1.7 2.2 3 5 3s5-1.3 5-3v-4.5"/><path d="M21 8v6"/>',
    ],

    'orang' => [
        'label' => 'Orang',
        'jalur' => '<circle cx="12" cy="8" r="4"/><path d="M4 21v-1a7 7 0 0 1 7-7h2a7 7 0 0 1 7 7v1"/>',
    ],

    'lokasi' => [
        'label' => 'Lokasi',
        'jalur' => '<path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/>',
    ],

];
