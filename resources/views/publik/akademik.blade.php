@extends('layouts.publik')

@section('judul', 'Akademik - '.pengaturan('nama_pendek'))
@section('deskripsi', 'Kurikulum, peminatan, kalender akademik, dan daftar prestasi siswa '.pengaturan('nama_pendek').'.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Akademik</p>
      <h1>Program Akademik</h1>
      <p>Kurikulum, peminatan, kalender kegiatan, dan capaian siswa {{ pengaturan('nama_pendek') }}.</p>
    </div>
  </section>
  <nav class="subnav" aria-label="Bagian halaman"><div class="wrap"><ul class="subnav__daftar"><li><a href="#kurikulum">Kurikulum</a></li><li><a href="#peminatan">Peminatan</a></li><li><a href="#kalender">Kalender akademik</a></li><li><a href="#prestasi">Prestasi</a></li></ul></div></nav>

  <section class="bagian" id="kurikulum">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Kurikulum</span>
        <h2>{{ pengaturan('kurikulum_judul') }}</h2>
        <p class="utama">{{ pengaturan('kurikulum_teks') }}</p>

        <div class="kisi kisi--2" style="margin-top:30px">
          <div class="kartu kartu--nomor">
            <span class="no">Rumpun umum</span>
            <h3>Mata pelajaran umum</h3>
            <p>{{ pengaturan('mapel_umum') }}</p>
          </div>
          <div class="kartu kartu--nomor">
            <span class="no">Rumpun agama</span>
            <h3>Mata pelajaran keagamaan</h3>
            <p>{{ pengaturan('mapel_agama') }}</p>
          </div>
        </div>
      </div>

      <aside class="kotak-info muncul">
        <h3>Jam belajar</h3>
        <ul>
          @foreach ($jadwal as $j)
            <li><strong>{{ $j->waktu }}</strong> {{ $j->kegiatan }}</li>
          @endforeach
        </ul>
        <p class="kecil abu" style="margin-top:14px">Hari Jumat jam belajar berakhir lebih awal.</p>
      </aside>
    </div>
  </section>

  <section class="bagian bagian--sage" id="peminatan">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Peminatan</span>
        <h2>Jalur yang bisa dipilih siswa</h2>
        <p class="utama">Pemilihan peminatan dilakukan di awal kelas X setelah wawancara bersama wali kelas.</p>
      </div>

      <div class="kisi kisi--3">
        @foreach ($peminatan as $p)
          <article class="kartu muncul">
            <div class="kartu__ikon"><x-ikon :nama="$p->ikon" /></div>
            <h3>{{ $p->kode }}</h3>
            <p class="kecil abu" style="margin-bottom:8px">{{ $p->nama }}</p>
            <p>{{ $p->keterangan }}</p>
            @if ($p->pendalaman)
              <p class="kecil abu" style="margin-top:10px">{{ $p->pendalaman }}</p>
            @endif
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bagian" id="kalender">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Kalender akademik</span>
        <h2>Agenda tahun ajaran {{ pengaturan('tahun_ajaran') }}</h2>
        <p class="utama">Jadwal dapat berubah menyesuaikan kalender pendidikan daerah dan Kementerian Agama.</p>
      </div>

      <div class="tabel-bungkus muncul">
        <table class="data">
          <caption class="kecil abu" style="caption-side:bottom;text-align:left;padding:14px 20px">Diperbarui setiap awal semester oleh bagian kurikulum.</caption>
          <thead>
            <tr><th>Bulan</th><th>Kegiatan</th><th>Keterangan</th></tr>
          </thead>
          <tbody>
            @foreach ($agenda as $a)
              <tr><td>{{ $a->periode }}</td><td>{{ $a->kegiatan }}</td><td>{{ $a->keterangan }}</td></tr>
            @endforeach
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
          tanpa dilebihkan.
        </p>
      </div>

      <ul class="prestasi muncul">
        @foreach ($prestasi as $p)
          @php
              // Juara 1 memakai medali emas, juara 2 perak, selebihnya perunggu.
              $kelas = str_contains($p->peringkat, '1') ? ''
                  : (str_contains($p->peringkat, '2') ? ' medali--perak' : ' medali--perunggu');
          @endphp
          <li>
            <span class="medali{{ $kelas }}">{{ $p->peringkat }}</span>
            <span><strong>{{ $p->judul }}</strong><span>{{ $p->keterangan }}</span></span>
            <span class="thn">{{ $p->tahun }}</span>
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
@endsection
