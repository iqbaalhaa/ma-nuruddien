@extends('layouts.publik')

@section('judul', 'Fasilitas & Kegiatan - MA Nuruddien')
@section('deskripsi', 'Sarana belajar, kegiatan ekstrakurikuler, dan galeri kegiatan Madrasah Aliyah Nuruddien.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Fasilitas</p>
      <h1>Fasilitas &amp; Kegiatan Siswa</h1>
      <p>Ruang, sarana, dan kegiatan yang menopang kegiatan belajar sehari-hari di MA Nuruddien.</p>
    </div>
  </section>
  <nav class="subnav" aria-label="Bagian halaman"><div class="wrap"><ul class="subnav__daftar"><li><a href="#sarana">Sarana belajar</a></li><li><a href="#ekskul">Ekstrakurikuler</a></li><li><a href="#galeri">Galeri kegiatan</a></li></ul></div></nav>

  <section class="bagian" id="sarana">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Sarana belajar</span>
        <h2>Delapan ruang yang dipakai bergantian setiap hari</h2>
        <p class="utama">Pilih salah satu untuk melihat keterangannya.</p>
      </div>

      <div class="kisi kisi--4">
        <button type="button" class="lengkung muncul" data-galeri="Ruang kelas" data-keterangan="Dua belas ruang kelas untuk tingkat X sampai XII, masing-masing berkapasitas sekitar 28 siswa dan dilengkapi papan tulis serta lemari arsip kelas.">
          <div class="lengkung__gambar lengkung__gambar--pucuk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="12" rx="2"/><path d="M7 20h10M9 16v4M15 16v4"/></svg></div>
          <div class="lengkung__teks"><h3>Ruang kelas</h3><p>12 rombongan belajar</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Laboratorium IPA" data-keterangan="Digunakan bergantian untuk praktikum fisika, kimia, dan biologi. Dilengkapi meja praktik, alat ukur dasar, mikroskop, dan lemari bahan.">
          <div class="lengkung__gambar lengkung__gambar--emas"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 3h6M10 3v6.5L5 19a2 2 0 0 0 1.8 3h10.4A2 2 0 0 0 19 19l-5-9.5V3"/><path d="M7.5 15h9"/></svg></div>
          <div class="lengkung__teks"><h3>Laboratorium IPA</h3><p>Fisika, kimia, biologi</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Laboratorium komputer" data-keterangan="Berisi unit komputer untuk mata pelajaran Informatika, latihan asesmen berbasis komputer, dan kegiatan English Club.">
          <div class="lengkung__gambar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.5" y="4" width="19" height="12" rx="2"/><path d="M8 20h8M12 16v4"/></svg></div>
          <div class="lengkung__teks"><h3>Laboratorium komputer</h3><p>Informatika &amp; asesmen</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Perpustakaan" data-keterangan="Menyimpan buku pelajaran, kitab rujukan, dan koleksi bacaan umum. Terbuka pada jam istirahat dan sepulang sekolah.">
          <div class="lengkung__gambar lengkung__gambar--tanah"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5a2 2 0 0 1 2-2h5v18H6a2 2 0 0 0-2 2z"/><path d="M20 5a2 2 0 0 0-2-2h-5v18h5a2 2 0 0 1 2 2z"/></svg></div>
          <div class="lengkung__teks"><h3>Perpustakaan</h3><p>Koleksi umum &amp; keagamaan</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Musala" data-keterangan="Tempat salat duha dan zuhur berjamaah, kajian pekanan, serta latihan tahfiz dan hadrah.">
          <div class="lengkung__gambar lengkung__gambar--pucuk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2c3.5 3.2 5 5.9 5 8.5V19H7v-8.5C7 7.9 8.5 5.2 12 2Z"/><path d="M4 22h16M12 10.5v8.5"/></svg></div>
          <div class="lengkung__teks"><h3>Musala</h3><p>Ibadah &amp; kajian</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Lapangan serbaguna" data-keterangan="Dipakai untuk upacara, PJOK, futsal, bola voli, dan latihan pramuka. Menjadi pusat kegiatan siswa di luar kelas.">
          <div class="lengkung__gambar lengkung__gambar--emas"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.5" y="5" width="19" height="14" rx="2"/><path d="M12 5v14M2.5 9.5h3v5h-3M21.5 9.5h-3v5h3"/><circle cx="12" cy="12" r="2.5"/></svg></div>
          <div class="lengkung__teks"><h3>Lapangan serbaguna</h3><p>Upacara &amp; olahraga</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Ruang guru &amp; tata usaha" data-keterangan="Pusat administrasi madrasah sekaligus tempat konsultasi siswa dengan wali kelas dan guru bimbingan.">
          <div class="lengkung__gambar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21V8l9-5 9 5v13"/><rect x="9" y="13" width="6" height="8"/><path d="M7 10h2M15 10h2"/></svg></div>
          <div class="lengkung__teks"><h3>Ruang guru &amp; TU</h3><p>Administrasi &amp; konsultasi</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Ruang UKS" data-keterangan="Ruang pertolongan pertama yang dikelola bersama pembina dan anggota Palang Merah Remaja madrasah.">
          <div class="lengkung__gambar lengkung__gambar--tanah"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="6" width="18" height="14" rx="3"/><path d="M12 10v6M9 13h6M8 6V4h8v2"/></svg></div>
          <div class="lengkung__teks"><h3>Ruang UKS</h3><p>Kesehatan siswa</p></div>
        </button>
      </div>
    </div>
  </section>

  <section class="bagian bagian--sage" id="ekskul">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Ekstrakurikuler</span>
        <h2>Delapan kegiatan, satu sore setiap pekan</h2>
        <p class="utama">
          Setiap siswa memilih paling sedikit satu kegiatan. Latihan dijadwalkan bergantian agar
          lapangan dan musala tidak berebut waktu.
        </p>
        <ul class="pil" style="margin-top:24px">
          <li>Pramuka</li>
          <li>Tahfiz Qur&rsquo;an</li>
          <li>Hadrah &amp; Marawis</li>
          <li>Palang Merah Remaja</li>
          <li>Futsal</li>
          <li>Bola voli</li>
          <li>Kaligrafi</li>
          <li>English Club</li>
        </ul>
      </div>

      <aside class="kotak-info muncul">
        <h3>Cara mengikuti</h3>
        <ul>
          <li>Pendataan minat dilakukan pada pekan kedua setiap semester.</li>
          <li>Latihan berlangsung setelah jam pelajaran, pukul 14.20 sampai 16.00.</li>
          <li>Setiap kegiatan didampingi satu pembina dari guru madrasah.</li>
          <li>Kehadiran ekstrakurikuler dicatat dan masuk ke laporan hasil belajar.</li>
        </ul>
      </aside>
    </div>
  </section>

  <section class="bagian" id="galeri">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Galeri kegiatan</span>
        <h2>Yang terjadi di madrasah sepanjang tahun</h2>
        <p class="utama">Dokumentasi kegiatan rutin dan momen besar madrasah.</p>
      </div>

      <div class="kisi kisi--4">
        <button type="button" class="lengkung muncul" data-galeri="Upacara bendera" data-keterangan="Dilaksanakan setiap Senin pagi di lapangan madrasah, dipimpin bergantian oleh petugas dari tiap kelas.">
          <div class="lengkung__gambar lengkung__gambar--pucuk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 22V3M6 4h12l-3 4 3 4H6"/></svg></div>
          <div class="lengkung__teks"><h3>Upacara bendera</h3><p>Setiap Senin</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Peringatan hari besar Islam" data-keterangan="Maulid Nabi, Isra Mikraj, dan Tahun Baru Hijriah diperingati bersama seluruh siswa dan wali murid.">
          <div class="lengkung__gambar lengkung__gambar--emas"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 15.5A8.5 8.5 0 1 1 11 3a7 7 0 0 0 9 12.5Z"/></svg></div>
          <div class="lengkung__teks"><h3>Hari besar Islam</h3><p>Peringatan bersama</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Praktikum laboratorium" data-keterangan="Siswa peminatan MIA melakukan praktik pengamatan dan pengukuran didampingi guru mata pelajaran.">
          <div class="lengkung__gambar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M18.4 5.6l-2.1 2.1M7.7 16.3l-2.1 2.1"/></svg></div>
          <div class="lengkung__teks"><h3>Praktikum</h3><p>Laboratorium IPA</p></div>
        </button>

        <button type="button" class="lengkung muncul" data-galeri="Wisuda kelas XII" data-keterangan="Pelepasan siswa kelas XII bersama wali murid, disertai penyerahan penghargaan bagi siswa berprestasi.">
          <div class="lengkung__gambar lengkung__gambar--tanah"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8l9-4 9 4-9 4z"/><path d="M7 10.5V15c0 1.7 2.2 3 5 3s5-1.3 5-3v-4.5"/><path d="M21 8v6"/></svg></div>
          <div class="lengkung__teks"><h3>Wisuda kelas XII</h3><p>Akhir tahun ajaran</p></div>
        </button>
      </div>
    </div>
  </section>
</main>
@endsection
