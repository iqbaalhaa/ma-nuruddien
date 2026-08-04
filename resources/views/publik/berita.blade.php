@extends('layouts.publik')

@section('judul', 'Berita & Pengumuman - MA Nuruddien')
@section('deskripsi', 'Kabar kegiatan, prestasi, dan pengumuman resmi Madrasah Aliyah Nuruddien Tanjung Jabung Barat.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Berita</p>
      <h1>Berita &amp; Pengumuman</h1>
      <p>Catatan kegiatan, capaian, dan informasi resmi dari Madrasah Aliyah Nuruddien.</p>
    </div>
  </section>
  

  <section class="bagian">
    <div class="wrap">
      <div class="alat">
        <div class="saring" role="group" aria-label="Saring berita berdasarkan kategori">
          <button class="saring__tbl" type="button" data-saring="semua" aria-pressed="true">Semua</button>
          <button class="saring__tbl" type="button" data-saring="kegiatan" aria-pressed="false">Kegiatan</button>
          <button class="saring__tbl" type="button" data-saring="prestasi" aria-pressed="false">Prestasi</button>
          <button class="saring__tbl" type="button" data-saring="pengumuman" aria-pressed="false">Pengumuman</button>
        </div>

        <div class="cari">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          <label class="sr-only" for="cari-berita">Cari berita</label>
          <input id="cari-berita" type="search" placeholder="Cari judul atau isi berita" data-cari>
        </div>
      </div>

      <div class="berita" data-daftar-berita>
        <article class="berita__item" data-kategori="kegiatan">
          <div class="berita__gambar"><span class="berita__label">Kegiatan</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2c3.5 3.2 5 5.9 5 8.5V19H7v-8.5C7 7.9 8.5 5.2 12 2Z"/><path d="M4 22h16"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">15 Mei 2026</span>
            <h3><a href="#">Pesantren kilat Ramadan diikuti seluruh siswa kelas X dan XI</a></h3>
            <p>Selama sepuluh hari siswa mengikuti kajian pagi, tadarus bersama, dan praktik ibadah yang dibimbing guru rumpun agama.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="prestasi">
          <div class="berita__gambar berita__gambar--emas"><span class="berita__label">Prestasi</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="9" r="6"/><path d="M8.5 14 7 22l5-2.5L17 22l-1.5-8"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">28 April 2026</span>
            <h3><a href="#">Tim tahfiz meraih juara dua MTQ tingkat kabupaten</a></h3>
            <p>Dua siswa kelas XI mewakili madrasah pada cabang tilawah dan hifzil Qur&rsquo;an lima juz yang digelar di Kuala Tungkal.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="pengumuman">
          <div class="berita__gambar berita__gambar--tanah"><span class="berita__label">Pengumuman</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">10 April 2026</span>
            <h3><a href="#">Jadwal ujian akhir semester genap tahun ajaran 2025/2026</a></h3>
            <p>Ujian berlangsung dua pekan. Kartu ujian dibagikan wali kelas paling lambat tiga hari sebelum pelaksanaan.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="kegiatan">
          <div class="berita__gambar berita__gambar--emas"><span class="berita__label">Kegiatan</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M18.4 5.6l-2.1 2.1M7.7 16.3l-2.1 2.1"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">22 Maret 2026</span>
            <h3><a href="#">Siswa peminatan MIA menggelar pameran hasil praktikum sederhana</a></h3>
            <p>Enam kelompok menampilkan percobaan biologi dan fisika di lapangan madrasah, disaksikan adik kelas dan guru.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="prestasi">
          <div class="berita__gambar"><span class="berita__label">Prestasi</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.5" y="5" width="19" height="14" rx="2"/><path d="M12 5v14"/><circle cx="12" cy="12" r="2.5"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">14 Maret 2026</span>
            <h3><a href="#">Tim futsal madrasah melaju ke babak semifinal piala Kemenag</a></h3>
            <p>Setelah menang dua laga penyisihan, tim putra MA Nuruddien memastikan tempat di empat besar turnamen antar madrasah.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="pengumuman">
          <div class="berita__gambar berita__gambar--tanah"><span class="berita__label">Pengumuman</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 11v2a1 1 0 0 0 1 1h3l5 4V6L7 10H4a1 1 0 0 0-1 1Z"/><path d="M16.5 9.5a4 4 0 0 1 0 5"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">2 Maret 2026</span>
            <h3><a href="#">Pemberitahuan libur awal Ramadan dan jadwal masuk kembali</a></h3>
            <p>Kegiatan belajar diliburkan pada tiga hari pertama Ramadan dan dilanjutkan dengan jadwal khusus bulan puasa.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="kegiatan">
          <div class="berita__gambar berita__gambar--emas"><span class="berita__label">Kegiatan</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s-7-4.5-7-10a7 7 0 0 1 14 0c0 5.5-7 10-7 10Z"/><circle cx="12" cy="11" r="2.5"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">18 Februari 2026</span>
            <h3><a href="#">Kunjungan belajar ke pusat kerajinan dan pelabuhan Kuala Tungkal</a></h3>
            <p>Siswa peminatan IIS mempelajari kegiatan ekonomi masyarakat pesisir secara langsung sebagai bahan tugas Geografi.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="kegiatan">
          <div class="berita__gambar"><span class="berita__label">Kegiatan</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9.5" cy="7" r="3.5"/><path d="M17 11.5 19 13.5 23 9.5"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">30 Januari 2026</span>
            <h3><a href="#">Pelatihan penguatan kompetensi guru rumpun agama</a></h3>
            <p>Delapan guru mengikuti pelatihan penyusunan modul ajar yang diselenggarakan Kantor Kementerian Agama kabupaten.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>

        <article class="berita__item" data-kategori="prestasi">
          <div class="berita__gambar berita__gambar--tanah"><span class="berita__label">Prestasi</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m4 18 6-6M9 7l8 8"/><path d="M14 4h6v6"/><path d="M20 4 10 14"/></svg></div>
          <div class="berita__teks">
            <span class="berita__tanggal">12 Januari 2026</span>
            <h3><a href="#">Siswa kelas XII meraih juara satu lomba kaligrafi pekan seni madrasah</a></h3>
            <p>Karya bertema kaligrafi kufi ini menjadi capaian pertama madrasah pada cabang seni Islam tahun ini.</p>
            <a class="tautan-panah" href="#">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
          </div>
        </article>
      </div>

      <p class="kosong">Tidak ada berita yang cocok dengan pilihan itu. Coba kata kunci lain atau pilih kategori Semua.</p>
    </div>
  </section>
</main>
@endsection
