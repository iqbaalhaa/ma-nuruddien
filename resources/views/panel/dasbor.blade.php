@extends('layouts.panel')

@section('judul', 'Dasbor')

@section('konten')

<div class="kabar">
  Anda masuk sebagai <strong>{{ auth()->user()->email }}</strong>.
  Halaman publik tidak menampilkan tautan apa pun ke panel ini.
</div>

<div class="kartu-panel">
  <h1>Dasbor</h1>
  <p>
    Selamat datang di panel pengelolaan situs MA Nuruddien. Isi halaman depan
    saat ini masih ditulis langsung di berkas tampilan; modul pengelolaan
    berita, profil, dan pesan kontak bisa ditambahkan di sini berikutnya.
  </p>

  <div class="kisi-panel">
    <div>
      <span class="angka-panel">6</span>
      <span class="label-panel">Halaman publik</span>
    </div>
    <div>
      <span class="angka-panel">{{ \App\Models\User::where('is_admin', true)->count() }}</span>
      <span class="label-panel">Akun admin</span>
    </div>
    <div>
      <span class="angka-panel">{{ auth()->user()->created_at?->format('Y') ?? '-' }}</span>
      <span class="label-panel">Akun dibuat</span>
    </div>
  </div>
</div>

@endsection
