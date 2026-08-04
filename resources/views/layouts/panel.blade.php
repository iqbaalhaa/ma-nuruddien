<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>@yield('judul', 'Panel') - MA Nuruddien</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Karla:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('ma-nuruddien/css/panel.css') }}">
</head>
<body>

<header class="panel-atas">
  <div class="panel-wrap panel-atas__isi">
    <div class="panel-atas__merek">
      MA Nuruddien
      <span>Panel Admin</span>
    </div>

    <div class="panel-atas__aksi">
      <span>{{ auth()->user()->name }}</span>
      <a href="{{ route('beranda') }}">Lihat situs</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="tbl-keluar" type="submit">Keluar</button>
      </form>
    </div>
  </div>
</header>

<main class="panel-isi">
  <div class="panel-wrap">
    @yield('konten')
  </div>
</main>

</body>
</html>
