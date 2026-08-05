<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>@yield('judul', 'Panel') - {{ pengaturan('nama_pendek', 'MA Nuruddien') }}</title>
@php $ikonSitus = pengaturan('favicon') ?: pengaturan('logo'); @endphp
<link rel="icon" href="{{ $ikonSitus ? asset('unggahan/'.$ikonSitus) : asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Karla:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('ma-nuruddien/css/panel.css') }}">
</head>
<body class="panel">

<a class="lompat" href="#isi-panel">Lompat ke konten</a>

<header class="panel-atas">
  <div class="panel-atas__isi">
    <button class="panel-menu" type="button" aria-expanded="false" aria-controls="sisi" aria-label="Buka menu panel">
      <span></span>
    </button>

    <div class="panel-atas__merek">
      MA Nuruddien
      <span>Panel Admin</span>
    </div>

    <div class="panel-atas__aksi">
      <a href="{{ route('beranda') }}" target="_blank" rel="noopener">Lihat situs</a>
      <span class="panel-atas__nama">{{ auth()->user()->name }}</span>
      <form method="POST" action="{{ route('panel.keluar') }}">
        @csrf
        <button class="tbl-keluar" type="submit">Keluar</button>
      </form>
    </div>
  </div>
</header>

<div class="panel-rangka">

  <nav class="sisi" id="sisi" aria-label="Menu panel">
    @php
        $menu = [
            'Ringkasan' => [
                ['panel.dasbor', 'Dasbor', 'gedung', null],
            ],
            'Isi halaman' => [
                ['panel.berita.indeks', 'Berita & pengumuman', 'kalender', null],
                ['panel.keunggulan.indeks', 'Keunggulan madrasah', 'guru', null],
                ['panel.prestasi.indeks', 'Prestasi siswa', 'piala', null],
                ['panel.fasilitas.indeks', 'Sarana belajar', 'kelas', null],
                ['panel.galeri.indeks', 'Galeri kegiatan', 'bendera', null],
                ['panel.ekstrakurikuler.indeks', 'Ekstrakurikuler', 'lapangan', null],
                ['panel.peminatan.indeks', 'Peminatan', 'buku', null],
                ['panel.agenda.indeks', 'Kalender akademik', 'wisuda', null],
                ['panel.jadwal-harian.indeks', 'Jam belajar harian', 'praktikum', null],
                ['panel.linimasa.indeks', 'Sejarah madrasah', 'perpustakaan', null],
                ['panel.misi.indeks', 'Misi madrasah', 'musala', null],
                ['panel.pengurus.indeks', 'Struktur organisasi', 'orang', null],
            ],
            'Kiriman pengunjung' => [
                ['panel.pesan.indeks', 'Pesan masuk', 'guru', $pesanBaru ?? 0],
                ['panel.tamu.indeks', 'Buku tamu', 'orang', $tamuBaru ?? 0],
            ],
            'Pengaturan' => [
                ['panel.pengaturan.indeks', 'Pengaturan situs', 'komputer', null],
            ],
        ];
    @endphp

    @foreach ($menu as $kelompok => $butir)
      <p class="sisi__kelompok">{{ $kelompok }}</p>
      <ul class="sisi__daftar">
        @foreach ($butir as [$rute, $label, $ikon, $lencana])
          @php $aktif = request()->routeIs(str_replace('.indeks', '', $rute).'.*') || request()->routeIs($rute); @endphp
          <li>
            <a class="sisi__tautan @if ($aktif) sisi__tautan--aktif @endif" href="{{ route($rute) }}">
              <x-ikon :nama="$ikon" class="sisi__ikon" />
              <span>{{ $label }}</span>
              @if ($lencana)
                <span class="lencana">{{ $lencana }}</span>
              @endif
            </a>
          </li>
        @endforeach
      </ul>
    @endforeach
  </nav>

  <main class="panel-isi" id="isi-panel">
    @if (session('kabar'))
      <p class="kabar" role="status">{{ session('kabar') }}</p>
    @endif

    @if ($errors->any())
      <div class="peringatan" role="alert">
        <strong>Ada yang perlu diperbaiki:</strong>
        <ul>
          @foreach ($errors->all() as $galat)
            <li>{{ $galat }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('konten')
  </main>

</div>

<script>
  document.querySelector('.panel-menu')?.addEventListener('click', function () {
    var buka = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', String(!buka));
    document.querySelector('.sisi').classList.toggle('sisi--buka', !buka);
  });

  // Hapus data selalu diminta konfirmasi, karena tidak bisa dibatalkan.
  document.querySelectorAll('form[data-konfirmasi]').forEach(function (f) {
    f.addEventListener('submit', function (e) {
      if (!confirm(f.dataset.konfirmasi)) e.preventDefault();
    });
  });
</script>
</body>
</html>
