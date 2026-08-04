<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Masuk Panel - MA Nuruddien</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Karla:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('ma-nuruddien/css/panel.css') }}">
</head>
<body>

<main class="masuk">
  <div class="masuk__kartu">
    <div class="masuk__merek">
      <svg viewBox="0 0 48 48" aria-hidden="true">
        <path d="M24 3 C34 12 39 20 39 28 v14 a3 3 0 0 1 -3 3 H12 a3 3 0 0 1 -3 -3 V28 C9 20 14 12 24 3 Z" fill="#1e5a4c"/>
        <path d="M24 16 l2.6 7.4 7.4 -0.6 -4.8 5.7 3.6 6.8 -8.8 -3.6 -8.8 3.6 3.6 -6.8 -4.8 -5.7 7.4 0.6 Z" fill="#c79a31"/>
      </svg>
      <span>
        <span class="masuk__nama">MA Nuruddien</span>
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
