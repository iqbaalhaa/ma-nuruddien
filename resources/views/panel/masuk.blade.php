<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Masuk Panel - {{ pengaturan('nama_pendek', 'MA Nuruddien') }}</title>
@php $ikonSitus = pengaturan('favicon') ?: pengaturan('logo'); @endphp
<link rel="icon" href="{{ $ikonSitus ? asset('unggahan/'.$ikonSitus) : asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Karla:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('ma-nuruddien/css/panel.css') }}">
</head>
<body>

<main class="masuk">
  <div class="masuk__kartu">
    <div class="masuk__merek">
      <x-lambang kelas="masuk__logo" />
      <span>
        <span class="masuk__nama">{{ pengaturan('nama_pendek', 'MA Nuruddien') }}</span>
        <span class="masuk__sub">Panel Admin</span>
      </span>
    </div>

    <h1>Masuk</h1>
    <p class="masuk__catatan">Halaman ini khusus pengelola madrasah. Tidak tersedia pendaftaran akun baru.</p>

    @if ($errors->any())
      <div class="peringatan" role="alert">
        <ul>
          @foreach ($errors->all() as $galat)
            <li>{{ $galat }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="medan">
        <label for="email">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          autocomplete="username"
          required
          autofocus
          @error('email') aria-invalid="true" @enderror>
      </div>

      <div class="medan">
        <label for="password">Kata sandi</label>
        <input
          id="password"
          type="password"
          name="password"
          autocomplete="current-password"
          required
          @error('password') aria-invalid="true" @enderror>
      </div>

      <label class="centang">
        <input type="checkbox" name="ingat" value="1" @checked(old('ingat'))>
        Ingat saya di perangkat ini
      </label>

      <button class="tbl-panel" type="submit">Masuk ke panel</button>
    </form>

    <p class="masuk__kaki">
      Lupa kata sandi? Hubungi pengelola server madrasah.<br>
      <a href="{{ route('beranda') }}">Kembali ke situs</a>
    </p>
  </div>
</main>

</body>
</html>
