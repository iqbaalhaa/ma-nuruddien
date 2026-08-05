@extends('layouts.publik')

@section('judul', 'Berita & Pengumuman - '.pengaturan('nama_pendek'))
@section('deskripsi', 'Kabar kegiatan, prestasi, dan pengumuman resmi '.pengaturan('nama_madrasah').'.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Berita</p>
      <h1>Berita &amp; Pengumuman</h1>
      <p>Catatan kegiatan, capaian, dan informasi resmi dari {{ pengaturan('nama_madrasah') }}.</p>
    </div>
  </section>

  <section class="bagian">
    <div class="wrap">
      <div class="alat">
        <div class="saring" role="group" aria-label="Saring berita berdasarkan kategori">
          <button class="saring__tbl" type="button" data-saring="semua" aria-pressed="true">Semua</button>
          @foreach (\App\Models\Berita::KATEGORI as $kunci => $label)
            <button class="saring__tbl" type="button" data-saring="{{ $kunci }}" aria-pressed="false">{{ $label }}</button>
          @endforeach
        </div>

        <div class="cari">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          <label class="sr-only" for="cari-berita">Cari berita</label>
          <input id="cari-berita" type="search" placeholder="Cari judul atau isi berita" data-cari>
        </div>
      </div>

      <div class="berita" data-daftar-berita>
        @forelse ($berita as $b)
          <article class="berita__item" data-kategori="{{ $b->kategori }}">
            <div class="berita__gambar berita__gambar--{{ $b->warna }}">
              <span class="berita__label">{{ $b->namaKategori() }}</span>
              @if ($b->gambar)
                <img src="{{ asset('unggahan/'.$b->gambar) }}" alt="{{ $b->judul }}" loading="lazy">
              @else
                <x-ikon :nama="$b->ikon" tebal="1.5" />
              @endif
            </div>
            <div class="berita__teks">
              <span class="berita__tanggal">{{ $b->tanggal->translatedFormat('j F Y') }}</span>
              <h3><a href="{{ route('berita.baca', $b) }}">{{ $b->judul }}</a></h3>
              <p>{{ $b->ringkasan }}</p>
              <a class="tautan-panah" href="{{ route('berita.baca', $b) }}">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
            </div>
          </article>
        @empty
          <p class="abu">Belum ada berita yang diterbitkan.</p>
        @endforelse
      </div>

      <p class="kosong-berita" data-kosong hidden>
        Tidak ada berita yang cocok dengan pilihan itu. Coba kata kunci lain atau pilih kategori Semua.
      </p>
    </div>
  </section>
</main>
@endsection
