@extends('layouts.panel')

@section('judul', 'Akun saya')

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>Akun saya</h1>
    <p>Nama, email, dan kata sandi untuk masuk ke panel. Situs ini tidak punya
       pemulihan kata sandi lewat email, jadi simpan yang baru di tempat aman.</p>
  </div>
</div>

<form class="borang-panel" method="POST" action="{{ route('panel.akun.perbarui') }}">
  @csrf
  @method('PUT')

  <h2 style="font-size:1.12rem;margin-bottom:20px">Nama dan email</h2>

  <div class="medan">
    <label for="name">Nama</label>
    <input id="name" type="text" name="name" value="{{ old('name', $pengguna->name) }}"
           @error('name') aria-invalid="true" @enderror>
    <p class="petunjuk">Tampil di pojok kanan atas panel.</p>
    @error('name')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="medan">
    <label for="email">Email</label>
    <input id="email" type="text" name="email" value="{{ old('email', $pengguna->email) }}"
           @error('email') aria-invalid="true" @enderror>
    <p class="petunjuk">Dipakai untuk masuk ke panel.</p>
    @error('email')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="kaki-borang">
    <button class="tbl-utama" type="submit">Simpan perubahan</button>
  </div>
</form>

<form class="borang-panel" method="POST" action="{{ route('panel.akun.sandi') }}" style="margin-top:24px">
  @csrf
  @method('PUT')

  <h2 style="font-size:1.12rem;margin-bottom:20px">Ganti kata sandi</h2>

  <div class="medan">
    <label for="sandi_lama">Kata sandi sekarang</label>
    <input id="sandi_lama" type="password" name="sandi_lama" autocomplete="current-password"
           @error('sandi_lama') aria-invalid="true" @enderror>
    <p class="petunjuk">Diminta untuk memastikan bukan orang lain yang memakai komputer Anda.</p>
    @error('sandi_lama')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="medan">
    <label for="sandi">Kata sandi baru</label>
    <input id="sandi" type="password" name="sandi" autocomplete="new-password"
           @error('sandi') aria-invalid="true" @enderror>
    <p class="petunjuk">Paling sedikit 8 karakter, harus memuat huruf dan angka.</p>
    @error('sandi')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="medan">
    <label for="sandi_confirmation">Ulangi kata sandi baru</label>
    <input id="sandi_confirmation" type="password" name="sandi_confirmation" autocomplete="new-password">
  </div>

  <div class="kaki-borang">
    <button class="tbl-utama" type="submit">Ganti kata sandi</button>
  </div>
</form>

@endsection
