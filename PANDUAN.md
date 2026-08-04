# Panduan singkat Website MA Nuruddien

## Halaman publik

| URL          | Isi                                    |
| ------------ | -------------------------------------- |
| `/`          | Beranda (dulu `index.html`)            |
| `/profil`    | Sejarah, visi & misi, struktur         |
| `/akademik`  | Kurikulum, peminatan, prestasi         |
| `/fasilitas` | Sarana belajar, ekstrakurikuler        |
| `/berita`    | Berita & pengumuman                    |
| `/kontak`    | Alamat, peta, formulir pesan           |

Tampilannya ada di `resources/views/publik/`, kerangka bersama (header, footer,
navigasi) di `resources/views/layouts/publik.blade.php`. Berkas HTML statis
aslinya diarsipkan di `resources/html-asli/` dan sudah tidak dilayani lagi ke
publik. Gambar, CSS, dan JS tetap di `public/ma-nuruddien/`.

## Panel admin

**URL masuk: `/panel/masuk`**. Hafalkan atau simpan alamat ini.

Halaman publik sengaja **tidak memuat tautan atau tombol apa pun** ke panel, dan
halaman panel ditandai `noindex, nofollow` serta diblokir lewat `robots.txt`.
Satu-satunya cara masuk adalah mengetik URL di atas.

Tidak ada registrasi. Akun dibuat lewat seeder:

```bash
php artisan db:seed --class=AdminSeeder
```

Seeder membaca `ADMIN_NAMA`, `ADMIN_EMAIL`, dan `ADMIN_PASSWORD` dari `.env`.
Untuk mengganti kata sandi, ubah `ADMIN_PASSWORD` di `.env` lalu jalankan ulang
perintah di atas (seeder memakai `updateOrCreate`, jadi akun tidak terduplikasi).

> **Penting:** ganti `ADMIN_PASSWORD` bawaan di `.env` sebelum situs dipakai
> sungguhan, dan pastikan `.env` tidak pernah ikut diunggah ke repositori.

Pengamanan yang sudah terpasang:

- Hanya akun dengan kolom `is_admin = true` yang boleh masuk; akun lain ditolak
  meski kata sandinya benar (middleware `admin`).
- Percobaan masuk dibatasi 5 kali per menit per IP (`throttle:5,1`).
- Sesi diperbarui setelah berhasil masuk untuk mencegah *session fixation*.

## Perintah yang sering dipakai

```bash
php artisan migrate          # jalankan migrasi
php artisan db:seed --class=AdminSeeder
php artisan serve            # jalankan di http://127.0.0.1:8000
php artisan test             # jalankan seluruh pengujian
```
