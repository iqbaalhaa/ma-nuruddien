# Website MA Nuruddien — Frontend

Frontend statis (HTML, CSS, JavaScript murni) untuk website Madrasah Aliyah Nuruddien,
Kabupaten Tanjung Jabung Barat, Jambi. Modul PPDB tidak disertakan.

## Struktur berkas

```
ma-nuruddien/
├── index.html          Beranda
├── profil.html         Sejarah, visi & misi, struktur, sambutan kepala
├── akademik.html       Kurikulum, peminatan, kalender akademik, prestasi
├── fasilitas.html      Sarana belajar, ekstrakurikuler, galeri kegiatan
├── berita.html         Berita & pengumuman (saring kategori + pencarian)
├── kontak.html         Alamat, peta, formulir pesan, buku tamu
├── css/style.css       Seluruh gaya tampilan
├── js/main.js          Seluruh skrip interaksi
└── assets/madrasah.svg Ilustrasi gedung madrasah
```

Cukup buka `index.html` di peramban. Semua berkas harus berada dalam satu folder
agar tautan antar halaman berfungsi.

## Yang sudah berjalan

- Navigasi enam halaman dengan penanda halaman aktif dan menu geser untuk ponsel.
- Tampilan responsif: satu kolom di ponsel, dua kolom di tablet, penuh di komputer.
- Animasi muncul saat digulir dan hitung angka statistik, dimatikan otomatis bila
  pengguna mengaktifkan *reduce motion*.
- Saring berita per kategori dan pencarian judul/isi secara langsung.
- Pratinjau galeri fasilitas (bisa ditutup dengan tombol Esc).
- Validasi formulir kontak beserta pesan galat berbahasa Indonesia.

## Yang perlu diganti sebelum dipakai

1. **Data madrasah.** Nama pejabat, tahun berdiri, jumlah siswa, prestasi, dan isi
   berita masih contoh. Sesuaikan dengan data sebenarnya.
2. **Kontak.** Alamat, nomor telepon, WhatsApp, dan email di footer serta halaman
   kontak masih penanda tempat.
3. **Peta.** Ganti alamat pada `src` iframe di `kontak.html` dengan koordinat persis
   lokasi madrasah.
4. **Foto.** Panel bergambar saat ini memakai ilustrasi dan pola. Ganti isi
   `.lengkung__gambar` dan `.berita__gambar` dengan tag `<img>` bila foto asli sudah ada.
5. **Formulir kontak.** Belum terhubung ke server. Untuk implementasi PHP + MySQL,
   arahkan `action` formulir ke skrip pengirim, lalu simpan pesan ke tabel basis data.

## Catatan teknis

Huruf Fraunces dan Karla dimuat dari Google Fonts, jadi butuh koneksi internet.
Untuk pemakaian luring, unduh berkas hurufnya dan ubah tautan di bagian `<head>`
setiap halaman.
