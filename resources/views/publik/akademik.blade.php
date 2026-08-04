@extends('layouts.publik')

@section('judul', 'Akademik - MA Nuruddien')
@section('deskripsi', 'Kurikulum terpadu, tiga peminatan, kalender akademik, dan daftar prestasi siswa MA Nuruddien.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Akademik</p>
      <h1>Program Akademik</h1>
      <p>Kurikulum, peminatan, kalender kegiatan, dan capaian siswa MA Nuruddien.</p>
    </div>
  </section>
  <nav class="subnav" aria-label="Bagian halaman"><div class="wrap"><ul class="subnav__daftar"><li><a href="#kurikulum">Kurikulum</a></li><li><a href="#peminatan">Peminatan</a></li><li><a href="#kalender">Kalender akademik</a></li><li><a href="#prestasi">Prestasi</a></li></ul></div></nav>

  <section class="bagian" id="kurikulum">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Kurikulum</span>
        <h2>Dua rumpun ilmu, satu jadwal belajar</h2>
        <p class="utama">
          MA Nuruddien menjalankan kurikulum nasional yang berlaku di madrasah aliyah, ditambah
          rumpun mata pelajaran keagamaan sesuai ketentuan Kementerian Agama.
        </p>
        <p>
          Kegiatan belajar berlangsung Senin sampai Sabtu. Pagi hari dibuka dengan tadarus dan
          salat duha berjamaah, dilanjutkan jam pelajaran reguler, lalu ditutup dengan salat zuhur
          berjamaah sebelum siswa pulang.
        </p>
        <div class="kisi kisi--2" style="margin-top:30px">
          <div class="kartu kartu--nomor">
            <span class="no">Rumpun umum</span>
            <h3>Mata pelajaran umum</h3>
            <p>Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, Kimia, Biologi, Ekonomi, Sosiologi, Geografi, Sejarah, PPKn, PJOK, Informatika, dan Seni Budaya.</p>
          </div>
          <div class="kartu kartu--nomor">
            <span class="no">Rumpun agama</span>
            <h3>Mata pelajaran keagamaan</h3>
            <p>Al-Qur&rsquo;an Hadis, Akidah Akhlak, Fikih, Sejarah Kebudayaan Islam, dan Bahasa Arab, ditambah program tahfiz harian.</p>
          </div>
        </div>
      </div>

      <aside class="kotak-info muncul">
        <h3>Jam belajar</h3>
        <ul>
          <li><strong>06.50</strong> Tadarus &amp; salat duha</li>
          <li><strong>07.30</strong> Jam pelajaran ke-1</li>
          <li><strong>09.50</strong> Istirahat pertama</li>
          <li><strong>12.10</strong> Salat zuhur berjamaah</li>
          <li><strong>12.40</strong> Jam pelajaran akhir</li>
          <li><strong>14.20</strong> Ekstrakurikuler (terjadwal)</li>
        </ul>
        <p class="kecil abu" style="margin-top:14px">Hari Jumat jam belajar berakhir lebih awal.</p>
      </aside>
    </div>
  </section>

  <section class="bagian bagian--sage" id="peminatan">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Peminatan</span>
        <h2>Tiga jalur yang bisa dipilih siswa</h2>
        <p class="utama">Pemilihan peminatan dilakukan di awal kelas X setelah wawancara bersama wali kelas.</p>
      </div>

      <div class="kisi kisi--3">
        <article class="kartu muncul">
          <div class="kartu__ikon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 3h6M10 3v6.5L5 19a2 2 0 0 0 1.8 3h10.4A2 2 0 0 0 19 19l-5-9.5V3"/><path d="M7.5 15h9"/></svg>
          </div>
          <h3>MIA</h3>
          <p class="kecil abu" style="margin-bottom:8px">Matematika &amp; Ilmu Alam</p>
          <p>Untuk siswa yang ingin melanjutkan ke bidang sains, kesehatan, teknik, atau pendidikan MIPA. Pendalaman pada Matematika, Fisika, Kimia, dan Biologi.</p>
        </article>

        <article class="kartu muncul">
          <div class="kartu__ikon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 20h18M6 20V9M12 20V4M18 20v-7"/></svg>
          </div>
          <h3>IIS</h3>
          <p class="kecil abu" style="margin-bottom:8px">Ilmu-ilmu Sosial</p>
          <p>Untuk siswa yang tertarik pada ekonomi, hukum, komunikasi, atau pemerintahan. Pendalaman pada Ekonomi, Sosiologi, Geografi, dan Sejarah.</p>
        </article>

        <article class="kartu muncul">
          <div class="kartu__ikon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v17H6.5A2.5 2.5 0 0 0 4 21.5z"/><path d="M12 6v7M9 9.5h6"/></svg>
          </div>
          <h3>Keagamaan</h3>
          <p class="kecil abu" style="margin-bottom:8px">Ilmu-ilmu Keagamaan</p>
          <p>Untuk siswa yang ingin mendalami studi Islam dan melanjutkan ke perguruan tinggi keagamaan. Pendalaman pada Tafsir, Hadis, Fikih, Ushul Fikih, dan Bahasa Arab.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="bagian" id="kalender">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Kalender akademik</span>
        <h2>Agenda tahun ajaran 2025/2026</h2>
        <p class="utama">Jadwal dapat berubah menyesuaikan kalender pendidikan daerah dan Kementerian Agama.</p>
      </div>

      <div class="tabel-bungkus muncul">
        <table class="data">
          <caption class="kecil abu" style="caption-side:bottom;text-align:left;padding:14px 20px">Diperbarui setiap awal semester oleh bagian kurikulum.</caption>
          <thead>
            <tr><th scope="col">Waktu</th><th scope="col">Kegiatan</th><th scope="col">Keterangan</th></tr>
          </thead>
          <tbody>
            <tr><td>Juli 2025</td><td>Awal tahun ajaran &amp; masa taaruf siswa</td><td>Pengenalan lingkungan madrasah</td></tr>
            <tr><td>September 2025</td><td>Penilaian tengah semester ganjil</td><td>Seluruh tingkat</td></tr>
            <tr><td>Desember 2025</td><td>Penilaian akhir semester ganjil</td><td>Dilanjutkan pembagian rapor</td></tr>
            <tr><td>Maret 2026</td><td>Pesantren kilat Ramadan</td><td>Kelas X dan XI</td></tr>
            <tr><td>April 2026</td><td>Ujian madrasah kelas XII</td><td>Tertulis dan praktik</td></tr>
            <tr><td>Mei 2026</td><td>Penilaian akhir semester genap</td><td>Kelas X dan XI</td></tr>
            <tr><td>Juni 2026</td><td>Wisuda &amp; pelepasan kelas XII</td><td>Bersama wali murid</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="bagian bagian--sage" id="prestasi">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Prestasi</span>
        <h2>Capaian siswa dalam tiga tahun terakhir</h2>
        <p class="utama">
          Sebagian besar diraih pada ajang tingkat kabupaten. Kami mencantumkannya apa adanya,
          termasuk yang belum sampai juara pertama.
        </p>
      </div>

      <ul class="prestasi muncul">
        <li>
          <span class="medali">Juara 1</span>
          <span><strong>Lomba Kaligrafi Islam</strong><span>Pekan Seni Madrasah tingkat kabupaten</span></span>
          <span class="thn">2025</span>
        </li>
        <li>
          <span class="medali medali--perak">Juara 2</span>
          <span><strong>MTQ cabang hifzil Qur&rsquo;an 5 juz</strong><span>Tingkat Kabupaten Tanjung Jabung Barat</span></span>
          <span class="thn">2026</span>
        </li>
        <li>
          <span class="medali medali--perak">Juara 2</span>
          <span><strong>Kompetisi Sains Madrasah bidang Biologi</strong><span>Seleksi tingkat kabupaten</span></span>
          <span class="thn">2024</span>
        </li>
        <li>
          <span class="medali medali--perunggu">Juara 3</span>
          <span><strong>Lomba Tingkat Regu Pramuka Penegak</strong><span>Kwartir Cabang Tanjung Jabung Barat</span></span>
          <span class="thn">2025</span>
        </li>
        <li>
          <span class="medali">Juara 1</span>
          <span><strong>Turnamen Futsal Antar Madrasah</strong><span>Piala Kemenag kabupaten</span></span>
          <span class="thn">2024</span>
        </li>
        <li>
          <span class="medali medali--perunggu">Juara 3</span>
          <span><strong>Lomba Pidato Bahasa Arab</strong><span>Pekan Seni Madrasah tingkat kabupaten</span></span>
          <span class="thn">2023</span>
        </li>
      </ul>
    </div>
  </section>
</main>
@endsection
