# Aturan kerja proyek MA Nuruddien

Website profil Madrasah Aliyah Nuruddien, Kuala Tungkal, Tanjung Jabung Barat.
Laravel 12, Blade, SQLite. Baca juga PANDUAN.md untuk daftar URL dan cara
membuat akun admin.

## 1. Ruang lingkup: CMS saja

Proyek ini cuma CMS untuk mengelola isi website madrasah. Yang boleh dibangun
adalah pengelolaan konten: berita, pengumuman, profil, fasilitas, galeri,
pesan masuk dari formulir kontak, dan halaman statis lain.

### PPDB tidak dibuat di sini

Jangan bangun sistem PPDB dalam bentuk apa pun. Yang dimaksud sistem PPDB
dan karena itu dilarang:

- formulir pendaftaran siswa baru
- tabel atau model pendaftar, berkas persyaratan, nomor pendaftaran
- alur seleksi, verifikasi berkas, pengumuman kelulusan
- login atau dasbor untuk calon siswa
- cetak kartu peserta, unggah dokumen, pembayaran

Yang masih boleh, kalau memang diminta, hanya halaman informasi PPDB yang
isinya teks biasa dan dikelola lewat CMS seperti berita: jadwal, syarat,
biaya, alur pendaftaran, kontak panitia. Sifatnya membaca saja. Kalau
pendaftaran perlu online, arahkan ke tautan luar atau nomor WhatsApp panitia,
jangan diproses di aplikasi ini.

Kalau ada permintaan yang mengarah ke sistem PPDB, sampaikan batas ini dulu
lalu tawarkan versi halaman informasinya.

## 2. Gaya penulisan

Semua teks yang dibaca orang, baik isi halaman, pesan galat, label tombol,
komentar kode, pesan commit, maupun balasan ke pengguna, ditulis dalam bahasa
Indonesia yang wajar. Tulis seperti orang menulis surat ke rekan kerja.

Yang dihindari:

- tanda pisah em dash. Pakai koma, titik, atau kalimat baru. Kalau butuh
  jeda, pecah jadi dua kalimat.
- pola "bukan sekadar A, melainkan B" dan sejenisnya
- kalimat pembuka yang mengulang pertanyaan sebelum menjawab
- kata sifat berlebihan seperti "canggih", "revolusioner", "mulus",
  "solusi menyeluruh"
- daftar poin yang isinya tiga frasa pendek berirama sama
- emoji di isi halaman dan di kode

Yang dipakai:

- kalimat pendek dan langsung
- angka dan fakta konkret kalau ada
- kalau sesuatu belum selesai atau belum jelas, tulis apa adanya

Isi halaman madrasah ditulis tenang dan sederhana, tidak seperti iklan.
Contoh nada yang sudah ada di beranda dan profil bisa jadi acuan.

## 3. Konvensi kode

Penamaan dalam bahasa Indonesia, mengikuti yang sudah ada:

- rute dan nama rute: `beranda`, `profil`, `panel.dasbor`, `login`, `logout`
- view: `resources/views/publik/` untuk halaman depan,
  `resources/views/panel/` untuk panel admin
- layout: `layouts/publik.blade.php` dan `layouts/panel.blade.php`
- controller memakai nama metode Indonesia (`tampilkan`, `masuk`, `keluar`,
  `indeks`)
- kelas CSS memakai kosakata yang sudah dipakai di `public/ma-nuruddien/css/style.css`
  (`wrap`, `bagian`, `kartu`, `kisi`, `mata`, `tbl`, `muncul`)

### Unggahan berkas

Jangan pernah memakai symlink untuk berkas unggahan. Artinya perintah
`php artisan storage:link` tidak boleh dijalankan, folder `public/storage`
tidak boleh dibuat, dan disk `public` bawaan Laravel tidak boleh dipakai.
Alasannya symlink sering gagal atau tidak diizinkan di WAMP dan di hosting
biasa, jadi foto bisa hilang begitu situs dipindah.

Semua unggahan disimpan langsung ke folder nyata di dalam `public/`. Disk
`unggahan` sudah disiapkan di `config/filesystems.php` dan mengarah ke
`public/unggahan`.

```php
// menyimpan
$path = $request->file('foto')->store('berita', 'unggahan');
// hasilnya misalnya "berita/abc123.jpg", simpan string ini di basis data

// menampilkan di Blade
<img src="{{ asset('unggahan/'.$berita->foto) }}" alt="...">

// menghapus
Storage::disk('unggahan')->delete($berita->foto);
```

Catatan tambahan:

- Pakai `asset()` untuk menampilkan, jangan `Storage::url()`, supaya tetap
  benar kalau aplikasi dijalankan dari subfolder WAMP.
- Buat subfolder per jenis konten (`berita/`, `galeri/`, `profil/`) supaya
  tidak menumpuk di satu tempat.
- Isi `public/unggahan` diabaikan git lewat `.gitignore` di dalamnya, tapi
  foldernya tetap ikut repositori. Jangan hapus berkas `.gitignore` itu.
- `unggahan` menjadi nama yang dipesan. Jangan membuat rute dengan segmen
  awal `/unggahan` karena akan tertutup oleh folder nyata ini.
- Validasi berkas yang masuk: batasi jenis (`jpg`, `jpeg`, `png`, `webp`),
  batasi ukuran, dan jangan pernah menerima `php`, `phtml`, atau `svg`.
  Simpan dengan nama acak, jangan memakai nama asli dari pengunggah.

Hal teknis yang perlu diingat:

- Jangan membuat folder di dalam `public/` yang namanya sama dengan segmen
  rute. `.htaccess` tidak me-rewrite request yang cocok dengan direktori
  nyata, jadi folder `public/panel/` akan membuat `/panel` jadi 404. Aset
  panel ditaruh di `public/ma-nuruddien/css/`.
- Tautan antar halaman selalu lewat `route()`, aset lewat `asset()`, jangan
  path absolut. Aplikasi bisa dijalankan dari subfolder WAMP.
- Berkas HTML asli sebelum konversi diarsipkan di `resources/html-asli/`.
  Jangan dilayani ke publik dan jangan dipakai sebagai sumber tampilan.
- Tidak ada registrasi. Akun admin hanya dibuat lewat `AdminSeeder` yang
  membaca `ADMIN_*` dari `.env`. Jangan menambah rute register atau reset
  password tanpa diminta.
- Halaman panel tidak boleh ditautkan dari halaman publik. URL masuk
  `/panel/masuk` sengaja hanya diketik manual.
- Kredensial tidak pernah ditulis di kode atau di file yang ikut repositori.

## 4. Menjalankan pengujian

Jangan menjalankan `php artisan test` sebagai kebiasaan setiap kali selesai
mengubah kode. Selesaikan pekerjaannya, laporkan apa yang diubah, selesai.

Jalankan pengujian hanya kalau salah satu dari ini terjadi:

- diminta langsung, misalnya "jalankan tes" atau "pastikan tidak ada yang rusak"
- perubahannya menyentuh autentikasi, rute, atau migrasi, dan tidak ada cara
  lain untuk tahu apakah masih jalan
- hendak menyatakan sesuatu sudah berfungsi padahal belum ada bukti apa pun

Poin terakhir yang paling penting. Boleh tidak menjalankan pengujian, tapi
tidak boleh mengaku sudah berfungsi tanpa memeriksanya. Kalau memang belum
diperiksa, katakan begitu apa adanya.

Untuk perubahan tampilan, tangkapan layar lewat peramban lebih berguna
daripada `php artisan test`, karena berkas pengujian tidak melihat tata letak.

Kalau menambah halaman publik, tetap daftarkan ke `tests/Feature/HalamanPublikTest.php`
supaya suite-nya tidak ketinggalan, walaupun saat itu tidak dijalankan.
