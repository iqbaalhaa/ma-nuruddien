@extends('layouts.publik')

@section('judul', $berita->judul.' - '.pengaturan('nama_pendek'))
@section('deskripsi', $berita->ringkasan)

@section('konten')
<main id="utama">

  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah">
        <a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp;
        <a href="{{ route('berita') }}">Berita</a> &nbsp;/&nbsp; {{ $berita->namaKategori() }}
      </p>
      <h1>{{ $berita->judul }}</h1>
      <p>{{ $berita->tanggal->translatedFormat('l, j F Y') }}</p>
    </div>
  </section>

  <article class="bagian">
    <div class="wrap naskah">

      @if ($berita->gambar)
        <figure class="naskah__gambar">
          <img src="{{ asset('unggahan/'.$berita->gambar) }}" alt="{{ $berita->judul }}">
        </figure>
      @endif

      <p class="utama">{{ $berita->ringkasan }}</p>

      {!! paragraf($berita->isi) !!}

      <p style="margin-top:36px">
        <a class="tautan-panah" href="{{ route('berita') }}">
          <span aria-hidden="true">&larr;</span> Kembali ke semua berita
        </a>
      </p>
    </div>
  </article>

  @if ($lainnya->isNotEmpty())
    <section class="bagian bagian--sage">
      <div class="wrap">
        <div class="kepala-bagian muncul">
          <span class="mata">Kabar lain</span>
          <h2>Berita lainnya</h2>
        </div>

        <div class="berita">
          @foreach ($lainnya as $b)
            <article class="berita__item muncul">
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
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>
  @endif

</main>
@endsection
