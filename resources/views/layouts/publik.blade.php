<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('judul', 'MA Nuruddien, Madrasah Aliyah di Tanjung Jabung Barat, Jambi')</title>
<meta name="description" content="@yield('deskripsi', pengaturan('deskripsi_situs'))">

{{-- Pratinjau saat tautan dibagikan lewat WhatsApp, Facebook, dan sejenisnya --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="MA Nuruddien">
<meta property="og:locale" content="id_ID">
<meta property="og:title" content="@yield('judul', 'MA Nuruddien, Madrasah Aliyah di Tanjung Jabung Barat, Jambi')">
<meta property="og:description" content="@yield('deskripsi', pengaturan('deskripsi_situs'))">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('ma-nuruddien/assets/gedung-madrasah-og.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Gedung MA Nuruddien bercat putih dan hijau dilihat dari halaman">
<meta name="twitter:card" content="summary_large_image">

{{-- Ikon tab peramban. Favicon dipakai lebih dulu, kalau belum diunggah
     logo yang dipakai, dan kalau keduanya kosong berkas bawaan Laravel. --}}
@php $ikonSitus = pengaturan('favicon') ?: pengaturan('logo'); @endphp
@if ($ikonSitus)
  <link rel="icon" href="{{ asset('unggahan/'.$ikonSitus) }}">
  <link rel="apple-touch-icon" href="{{ asset('unggahan/'.$ikonSitus) }}">
@else
  <link rel="icon" href="{{ asset('favicon.ico') }}">
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Karla:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('ma-nuruddien/css/style.css') }}">
</head>
<body>
<a class="lompat" href="#utama">Lompat ke konten utama</a>

<!-- ================= HEADER ================= -->
{{-- Halaman dengan hero berlatar foto memakai header melayang yang tembus
     pandang di puncak halaman, lalu memadat saat digulir. --}}
<header class="header @yield('kelas-header')">
  <div class="wrap header__isi">
    <a class="merek" href="{{ route('beranda') }}">
      <x-lambang />
      <span>
        <span class="merek__nama">{{ pengaturan("nama_pendek") }}</span>
        <span class="merek__sub">{{ pengaturan("wilayah") }}</span>
      </span>
    </a>

    <button class="tombol-menu" type="button" aria-expanded="false" aria-controls="nav-utama" aria-label="Buka menu navigasi">
      <span></span>
    </button>

    <nav class="nav" id="nav-utama" aria-label="Navigasi utama">
      <ul class="nav__daftar">
        @foreach (['beranda' => 'Beranda', 'profil' => 'Profil', 'akademik' => 'Akademik', 'fasilitas' => 'Fasilitas', 'berita' => 'Berita', 'kontak' => 'Kontak'] as $rute => $label)
          <li>
            <a class="nav__tautan" href="{{ route($rute) }}" @if (request()->routeIs($rute)) aria-current="page" @endif>{{ $label }}</a>
          </li>
        @endforeach
      </ul>
    </nav>
  </div>
</header>

@yield('konten')

<!-- ================= FOOTER ================= -->
<footer class="footer">
  <div class="wrap">
    <div class="footer__kisi">
      <div class="footer__merek">
        <a class="merek" href="{{ route('beranda') }}">
          <x-lambang warna="#2a6b5b" />
          <span>
            <span class="merek__nama">{{ pengaturan("nama_pendek") }}</span>
            <span class="merek__sub">{{ pengaturan("wilayah") }}</span>
          </span>
        </a>
        <p>{{ pengaturan('tentang_footer') }}</p>
        <div class="sosial">
          @if (pengaturan('facebook'))
            <a href="{{ pengaturan('facebook') }}" aria-label="Facebook {{ pengaturan('nama_pendek') }}"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-8h2.7l.4-3h-3.1V8.1c0-.9.3-1.5 1.5-1.5h1.7V4c-.3 0-1.3-.1-2.4-.1-2.4 0-4.1 1.5-4.1 4.2V10H7.5v3h2.7v8z"/></svg></a>
          @endif
          @if (pengaturan('instagram'))
            <a href="{{ pengaturan('instagram') }}" aria-label="Instagram {{ pengaturan('nama_pendek') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" stroke="none"/></svg></a>
          @endif
          @if (pengaturan('youtube'))
            <a href="{{ pengaturan('youtube') }}" aria-label="YouTube {{ pengaturan('nama_pendek') }}"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2c-.2-.9-.9-1.6-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4c-.9.2-1.6.9-1.8 1.8C2 8.8 2 12 2 12s0 3.2.4 4.8c.2.9.9 1.6 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4c.9-.2 1.6-.9 1.8-1.8.4-1.6.4-4.8.4-4.8s0-3.2-.4-4.8ZM10 15V9l5.2 3z"/></svg></a>
          @endif
        </div>
      </div>

      <div>
        <h4>Halaman</h4>
        <ul>
          <li><a href="{{ route('beranda') }}">Beranda</a></li>
          <li><a href="{{ route('profil') }}">Profil</a></li>
          <li><a href="{{ route('akademik') }}">Akademik</a></li>
          <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
          <li><a href="{{ route('berita') }}">Berita</a></li>
          <li><a href="{{ route('kontak') }}">Kontak</a></li>
        </ul>
      </div>

      <div>
        <h4>Tentang</h4>
        <ul>
          <li><a href="{{ route('profil') }}#sejarah">Sejarah</a></li>
          <li><a href="{{ route('profil') }}#visi-misi">Visi &amp; misi</a></li>
          <li><a href="{{ route('profil') }}#struktur">Struktur organisasi</a></li>
          <li><a href="{{ route('akademik') }}#prestasi">Prestasi</a></li>
          <li><a href="{{ route('fasilitas') }}#ekskul">Ekstrakurikuler</a></li>
        </ul>
      </div>

      <div>
        <h4>Alamat</h4>
        <ul>
          <li>{!! nl2br(e(pengaturan('alamat'))) !!}</li>
          <li><a href="tel:{{ preg_replace('~\D~', '', pengaturan('telepon')) }}">{{ pengaturan('telepon') }}</a></li>
          <li><a href="mailto:{{ pengaturan('email') }}">{{ pengaturan('email') }}</a></li>
        </ul>
      </div>
    </div>

    <div class="footer__bawah">
      <span>&copy; <span data-tahun>{{ date('Y') }}</span> {{ pengaturan('nama_madrasah') }}, {{ pengaturan('wilayah') }}, Jambi.</span>
      <span>Dirancang sebagai media promosi digital madrasah.</span>
    </div>
  </div>
</footer>

<script src="{{ asset('ma-nuruddien/js/main.js') }}"></script>
@stack('skrip')
</body>
</html>
