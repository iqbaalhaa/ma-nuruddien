# Panduan singkat Website MA Nuruddien

## Halaman publik

| URL          | Isi                                    |
| ------------ | -------------------------------------- |
| `/`          | Beranda (dulu `index.html`)            |
| `/profil`    | Sejarah, visi & misi, struktur         |
| `/akademik`  | Kurikulum, peminatan, prestasi         |
| `/fasilitas` | Sarana belajar, ekstrakurikuler        |
| `/berita`    | Berita & pengumuman                    |
| `/berita/{slug}` | Satu berita utuh                   |
| `/kontak`    | Alamat, peta, formulir pesan, buku tamu |

Tampilannya ada di `resources/views/publik/`, kerangka bersama (header, footer,
navigasi) di `resources/views/layouts/publik.blade.php`. Berkas HTML statis
aslinya diarsipkan di `resources/html-asli/` dan sudah tidak dilayani lagi ke
publik. Gambar, CSS, dan JS tetap di `public/ma-nuruddien/`.

Seluruh isi halaman ini datang dari basis data, jadi mengubah teksnya cukup
lewat panel admin tanpa menyentuh kode.

## Apa yang bisa diubah dari panel

| Menu panel | Mengubah bagian |
| ---------- | --------------- |
| Berita & pengumuman | Halaman Berita, dan tiga terbaru di beranda |
| Keunggulan madrasah | Tiga kartu di beranda |
| Prestasi siswa | Daftar capaian di halaman Akademik |
| Sarana belajar | Kartu fasilitas di halaman Fasilitas dan beranda |
| Galeri kegiatan | Galeri di halaman Fasilitas |
| Ekstrakurikuler | Daftar kegiatan di halaman Fasilitas |
| Peminatan | Tiga jalur di halaman Akademik |
| Kalender akademik | Tabel agenda tahun ajaran |
| Jam belajar harian | Kotak jam belajar di halaman Akademik |
| Sejarah madrasah | Linimasa di halaman Profil |
| Misi madrasah | Daftar bernomor di halaman Profil |
| Struktur organisasi | Bagan di halaman Profil |
| Pengaturan situs | Nama, logo, favicon, hero, statistik, visi, kontak, media sosial |
| Akun saya | Nama, email, dan kata sandi untuk masuk |
| Pesan masuk | Kiriman formulir kontak |
| Buku tamu | Persetujuan pesan pengunjung |

Menu daftar punya tombol panah naik dan turun untuk mengatur urutan tampil.

**Logo dan favicon** diunggah lewat Pengaturan situs, tab Identitas situs.
Kalau dikosongkan, lambang bawaan yang dipakai. Terima JPG, PNG, dan WEBP
sampai 3 MB. Berkas SVG sengaja ditolak karena bisa memuat skrip.

Foto yang diunggah masuk ke `public/unggahan/`, bukan lewat symlink, supaya
tetap jalan saat situs dipindah ke hosting.

## Panel admin

**URL masuk: `/panel/masuk`**. Hafalkan atau simpan alamat ini.

Halaman publik sengaja **tidak memuat tautan atau tombol apa pun** ke panel, dan
halaman panel ditandai `noindex, nofollow` serta diblokir lewat `robots.txt`.
Satu-satunya cara masuk adalah mengetik URL di atas.

Tidak ada registrasi. Akun pertama dibuat lewat seeder:

```bash
php artisan db:seed --class=AdminSeeder
```

Seeder membaca `ADMIN_NAMA`, `ADMIN_EMAIL`, dan `ADMIN_PASSWORD` dari `.env`,
tetapi kata sandi hanya ditulis saat akunnya belum ada. Kalau akunnya sudah
ada, kata sandinya tidak disentuh, jadi menjalankan seeder ulang tidak akan
mengembalikan kata sandi yang sudah Anda ganti.

**Mengganti kata sandi sehari-hari lewat panel**, bukan lewat `.env`: masuk,
lalu buka menu **Akun saya**. Di sana juga bisa mengubah nama dan email.
Kata sandi baru paling sedikit 8 karakter dan harus memuat huruf serta angka.

Tidak ada pemulihan kata sandi lewat email. Kalau kata sandi hilang, satu-satunya
jalan adalah menyetelnya ulang dari server:

```bash
php artisan tinker --execute="App\Models\User::where('email','admin@sekolah.com')->first()->update(['password' => Hash::make('SandiBaru123')]);"
```

Kalau email di panel diubah, sesuaikan juga `ADMIN_EMAIL` di `.env`. Kalau
tidak, seeder akan mengira akunnya belum ada lalu membuat admin kedua. Seeder
memperingatkan hal ini setiap kali dijalankan.

> **Penting:** ganti `ADMIN_PASSWORD` bawaan di `.env` sebelum situs dipakai
> sungguhan, dan pastikan `.env` tidak pernah ikut diunggah ke repositori.

Pengamanan yang sudah terpasang:

- Hanya akun dengan kolom `is_admin = true` yang boleh masuk; akun lain ditolak
  meski kata sandinya benar (middleware `admin`).
- Percobaan masuk dibatasi 5 kali per menit per IP (`throttle:5,1`).
- Sesi diperbarui setelah berhasil masuk untuk mencegah *session fixation*.

## Perintah yang sering dipakai

```bash
php artisan migrate                        # jalankan migrasi
php artisan db:seed                        # akun admin + seluruh isi awal situs
php artisan db:seed --class=AdminSeeder    # akun admin saja
php artisan serve                          # jalankan di http://127.0.0.1:8000
php artisan test                           # jalankan seluruh pengujian
```

Seeder isi aman dijalankan ulang. Tabel yang sudah berisi data dilewati, jadi
hasil kerja admin di panel tidak akan tertimpa.

## Basis data

Proyek ini memakai MySQL. SQLite tidak dipakai lagi.

### Menyiapkan dari nol

```bash
cp .env.example .env
php artisan key:generate
# buat basis datanya dulu, misalnya lewat phpMyAdmin, dengan nama
# ma_nuruddien dan set karakter utf8mb4_unicode_ci
php artisan migrate
php artisan db:seed
```

Laravel tidak membuat basis datanya sendiri, jadi langkah pembuatan di
atas wajib dilakukan lebih dulu. Kalau belum ada, `migrate` akan berhenti
dengan pesan `Unknown database`.

Pastikan juga layanan MySQL di WAMP sudah menyala. Kalau mati, semua
halaman menampilkan galat `No connection could be made`.

### Catatan lingkungan

WAMP di komputer ini menjalankan dua server basis data sekaligus:
PHP terhubung ke MySQL 8.3 di port 3306, sedangkan `mysql.exe` di PATH adalah
klien MariaDB yang menunjuk server lain. Kalau perlu memeriksa isi basis data,
pakai `php artisan tinker` supaya pasti mengenai server yang benar.

Mesin penyimpanan bawaannya MyISAM, yang batas kunci indeksnya cuma 1000 byte
sehingga kolom `unique` bertipe utf8mb4 langsung gagal dibuat. Karena itu
`config/database.php` memaksa InnoDB.
