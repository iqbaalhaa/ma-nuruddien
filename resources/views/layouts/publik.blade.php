<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('judul', 'MA Nuruddien, Madrasah Aliyah di Tanjung Jabung Barat, Jambi')</title>
<meta name="description" content="@yield('deskripsi', 'Madrasah Aliyah Nuruddien Kabupaten Tanjung Jabung Barat. Kurikulum terpadu umum dan agama, guru bersertifikasi, dan pembinaan karakter untuk generasi berakhlak, cerdas, dan berprestasi.')">

{{-- Pratinjau saat tautan dibagikan lewat WhatsApp, Facebook, dan sejenisnya --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="MA Nuruddien">
<meta property="og:locale" content="id_ID">
<meta property="og:title" content="@yield('judul', 'MA Nuruddien, Madrasah Aliyah di Tanjung Jabung Barat, Jambi')">
<meta property="og:description" content="@yield('deskripsi', 'Madrasah Aliyah Nuruddien Kabupaten Tanjung Jabung Barat. Kurikulum terpadu umum dan agama, guru bersertifikasi, dan pembinaan karakter untuk generasi berakhlak, cerdas, dan berprestasi.')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('ma-nuruddien/assets/gedung-madrasah-og.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Gedung MA Nuruddien bercat putih dan hijau dilihat dari halaman">
<meta name="twitter:card" content="summary_large_image">

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
      <svg class="merek__lambang" viewBox="0 0 48 48" aria-hidden="true">
        <path d="M24 3 C34 12 39 20 39 28 v14 a3 3 0 0 1 -3 3 H12 a3 3 0 0 1 -3 -3 V28 C9 20 14 12 24 3 Z" fill="#1e5a4c"/>
        <path d="M24 16 l2.6 7.4 7.4 -0.6 -4.8 5.7 3.6 6.8 -8.8 -3.6 -8.8 3.6 3.6 -6.8 -4.8 -5.7 7.4 0.6 Z" fill="#c79a31"/>
      </svg>
      <span>
        <span class="merek__nama">MA Nuruddien</span>
        <span class="merek__sub">Tanjung Jabung Barat</span>
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
          <svg class="merek__lambang" viewBox="0 0 48 48" aria-hidden="true">
            <path d="M24 3 C34 12 39 20 39 28 v14 a3 3 0 0 1 -3 3 H12 a3 3 0 0 1 -3 -3 V28 C9 20 14 12 24 3 Z" fill="#2a6b5b"/>
            <path d="M24 16 l2.6 7.4 7.4 -0.6 -4.8 5.7 3.6 6.8 -8.8 -3.6 -8.8 3.6 3.6 -6.8 -4.8 -5.7 7.4 0.6 Z" fill="#c79a31"/>
          </svg>
          <span>
            <span class="merek__nama">MA Nuruddien</span>
            <span class="merek__sub">Tanjung Jabung Barat</span>
          </span>
        </a>
        <p>Madrasah Aliyah swasta di Kuala Tungkal, Provinsi Jambi. Membina siswa dengan ilmu umum dan ilmu agama sejak 2003.</p>
        <div class="sosial">
          <a href="#" aria-label="Facebook MA Nuruddien"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-8h2.7l.4-3h-3.1V8.1c0-.9.3-1.5 1.5-1.5h1.7V4c-.3 0-1.3-.1-2.4-.1-2.4 0-4.1 1.5-4.1 4.2V10H7.5v3h2.7v8z"/></svg></a>
          <a href="#" aria-label="Instagram MA Nuruddien"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" stroke="none"/></svg></a>
          <a href="#" aria-label="YouTube MA Nuruddien"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2c-.2-.9-.9-1.6-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4c-.9.2-1.6.9-1.8 1.8C2 8.8 2 12 2 12s0 3.2.4 4.8c.2.9.9 1.6 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4c.9-.2 1.6-.9 1.8-1.8.4-1.6.4-4.8.4-4.8s0-3.2-.4-4.8ZM10 15V9l5.2 3z"/></svg></a>
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
          <li>Jl. Pendidikan No. 12, Kuala Tungkal<br>Kabupaten Tanjung Jabung Barat<br>Provinsi Jambi 36513</li>
          <li><a href="tel:+62741000000">(0742) 000 000</a></li>
          <li><a href="mailto:info@manuruddien.sch.id">info&#64;manuruddien.sch.id</a></li>
        </ul>
      </div>
    </div>

    <div class="footer__bawah">
      <span>&copy; <span data-tahun>{{ date('Y') }}</span> Madrasah Aliyah Nuruddien, Tanjung Jabung Barat, Jambi.</span>
      <span>Dirancang sebagai media promosi digital madrasah.</span>
    </div>
  </div>
</footer>

<script src="{{ asset('ma-nuruddien/js/main.js') }}"></script>
@stack('skrip')
</body>
</html>
