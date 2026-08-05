@extends('layouts.publik')

@section('judul', 'Fasilitas & Kegiatan - '.pengaturan('nama_pendek'))
@section('deskripsi', 'Sarana belajar, kegiatan ekstrakurikuler, dan galeri kegiatan '.pengaturan('nama_madrasah').'.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Fasilitas</p>
      <h1>Fasilitas &amp; Kegiatan Siswa</h1>
      <p>Ruang, sarana, dan kegiatan yang menopang kegiatan belajar sehari-hari di {{ pengaturan('nama_pendek') }}.</p>
    </div>
  </section>
  <nav class="subnav" aria-label="Bagian halaman"><div class="wrap"><ul class="subnav__daftar"><li><a href="#sarana">Sarana belajar</a></li><li><a href="#ekskul">Ekstrakurikuler</a></li><li><a href="#galeri">Galeri kegiatan</a></li></ul></div></nav>

  <section class="bagian" id="sarana">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Sarana belajar</span>
        <h2>Ruang yang dipakai bergantian setiap hari</h2>
        <p class="utama">Klik salah satu kartu untuk membaca keterangannya.</p>
      </div>

      <div class="kisi kisi--4">
        @foreach ($fasilitas as $f)
          <button type="button" class="lengkung muncul"
                  data-galeri="{{ $f->nama }}" data-keterangan="{{ $f->keterangan }}">
            <div class="lengkung__gambar lengkung__gambar--{{ $f->warna }}">
              @if ($f->gambar)
                <img src="{{ asset('unggahan/'.$f->gambar) }}" alt="{{ $f->nama }}" loading="lazy">
              @else
                <x-ikon :nama="$f->ikon" tebal="1.5" />
              @endif
            </div>
            <div class="lengkung__teks"><h3>{{ $f->nama }}</h3><p>{{ $f->ringkas }}</p></div>
          </button>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bagian bagian--sage" id="ekskul">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Ekstrakurikuler</span>
        <h2>{{ $ekskul->count() }} kegiatan, satu sore setiap pekan</h2>
        <p class="utama">
          Setiap siswa memilih paling sedikit satu kegiatan. Latihan dijadwalkan bergantian agar
          lapangan dan musala tidak berebut waktu.
        </p>
        <ul class="pil" style="margin-top:24px">
          @foreach ($ekskul as $e)
            <li>{{ $e->nama }}</li>
          @endforeach
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
        <span class="mata">Galeri</span>
        <h2>Kegiatan yang rutin berjalan</h2>
        <p class="utama">Dokumentasi kegiatan rutin dan momen besar madrasah.</p>
      </div>

      <div class="kisi kisi--4">
        @foreach ($galeri as $g)
          <button type="button" class="lengkung muncul"
                  data-galeri="{{ $g->judul }}" data-keterangan="{{ $g->keterangan }}">
            <div class="lengkung__gambar lengkung__gambar--{{ $g->warna }}">
              @if ($g->gambar)
                <img src="{{ asset('unggahan/'.$g->gambar) }}" alt="{{ $g->judul }}" loading="lazy">
              @else
                <x-ikon :nama="$g->ikon" tebal="1.5" />
              @endif
            </div>
            <div class="lengkung__teks"><h3>{{ $g->judul }}</h3><p>{{ $g->ringkas }}</p></div>
          </button>
        @endforeach
      </div>
    </div>
  </section>
</main>
@endsection
