@extends('layouts.panel')

@section('judul', 'Pengaturan situs')

@section('konten')

@php $grup = \App\Http\Controllers\Panel\PengaturanController::GRUP; @endphp

<div class="kepala-panel">
  <div>
    <h1>Pengaturan situs</h1>
    <p>Teks tunggal yang muncul di berbagai halaman. Daftar berisi banyak baris, seperti berita atau prestasi, diatur lewat menunya sendiri.</p>
  </div>
</div>

<nav class="tab-pengaturan" aria-label="Bagian pengaturan">
  @foreach ($grup as $kunci => [$label, $keterangan])
    <a href="{{ route('panel.pengaturan.indeks', $kunci) }}"
       @if ($kunci === $grupAktif) aria-current="page" @endif>{{ $label }}</a>
  @endforeach
</nav>

<form class="borang-panel" method="POST" action="{{ route('panel.pengaturan.simpan', $grupAktif) }}"
      enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <p style="margin:0 0 24px;color:var(--abu);font-size:.92rem">{{ $grup[$grupAktif][1] }}</p>

  @foreach ($kolom as $k)
    @php
      // Kolom gambar dikirim sebagai berkas, jadi namanya tanpa awalan "nilai".
      $medan = $k->jenis === 'gambar' ? $k->kunci : 'nilai.'.$k->kunci;
      $nilai = old('nilai.'.$k->kunci, $k->nilai);
      $salah = $errors->has($medan);
    @endphp

    <div class="medan">
      <label for="{{ $k->kunci }}">{{ $k->label }}</label>

      @if ($k->jenis === 'gambar')
        @if ($k->nilai)
          <div class="pratinjau-gambar">
            <img src="{{ asset('unggahan/'.$k->nilai) }}" alt="{{ $k->label }} saat ini"
                 style="width:96px;height:96px;object-fit:contain;background:var(--sage)">
            <label class="sakelar" style="margin:0">
              <input type="checkbox" name="hapus_{{ $k->kunci }}" value="1">
              Hapus dan kembali ke bawaan
            </label>
          </div>
        @endif
        <input id="{{ $k->kunci }}" type="file" name="{{ $k->kunci }}" accept=".jpg,.jpeg,.png,.webp"
               @if ($salah) aria-invalid="true" @endif>

      @elseif ($k->jenis === 'panjang')
        <textarea id="{{ $k->kunci }}" name="nilai[{{ $k->kunci }}]"
                  @if ($salah) aria-invalid="true" @endif>{{ $nilai }}</textarea>
      @elseif ($k->jenis === 'angka')
        <input id="{{ $k->kunci }}" type="number" name="nilai[{{ $k->kunci }}]" value="{{ $nilai }}"
               @if ($salah) aria-invalid="true" @endif>
      @else
        <input id="{{ $k->kunci }}" type="text" name="nilai[{{ $k->kunci }}]" value="{{ $nilai }}"
               @if ($salah) aria-invalid="true" @endif>
      @endif

      @if ($salah)
        <p class="petunjuk" style="color:var(--tanah)">{{ $errors->first($medan) }}</p>
      @elseif ($k->petunjuk)
        <p class="petunjuk">{{ $k->petunjuk }}</p>
      @endif
    </div>
  @endforeach

  <div class="kaki-borang">
    <button class="tbl-utama" type="submit">Simpan pengaturan</button>
    <a class="tbl-biasa" href="{{ route('beranda') }}" target="_blank" rel="noopener">Lihat hasilnya di situs</a>
  </div>
</form>

@endsection
