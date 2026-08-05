@extends('layouts.panel')

@section('judul', ($baru ? 'Tambah ' : 'Ubah ').$satuan)

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>{{ $baru ? 'Tambah' : 'Ubah' }} {{ $satuan }}</h1>
    <p>{{ $judul }}</p>
  </div>
  <a class="tbl-biasa" href="{{ route("panel.$rute.indeks") }}">Kembali ke daftar</a>
</div>

<form class="borang-panel" method="POST" action="{{ $aksi }}" enctype="multipart/form-data">
  @csrf
  @unless ($baru)
    @method('PUT')
  @endunless

  @foreach ($medan as $m)
    @php
      $nama = $m['nama'];
      $jenis = $m['jenis'] ?? 'teks';
      $nilai = old($nama, $data->{$nama});
      $salah = $errors->has($nama);
    @endphp

    <div class="medan">
      <label for="{{ $nama }}">{{ $m['label'] }}</label>

      @if ($jenis === 'panjang')
        <textarea id="{{ $nama }}" name="{{ $nama }}" @if ($salah) aria-invalid="true" @endif>{{ $nilai }}</textarea>

      @elseif ($jenis === 'pilih')
        <select id="{{ $nama }}" name="{{ $nama }}" @if ($salah) aria-invalid="true" @endif>
          @foreach ($m['pilihan'] as $kunci => $label)
            <option value="{{ $kunci }}" @selected((string) $nilai === (string) $kunci)>{{ $label }}</option>
          @endforeach
        </select>

      @elseif ($jenis === 'ikon')
        <div class="pilih-ikon">
          @foreach (config('ikon') as $kunci => $ikon)
            <input type="radio" id="ikon-{{ $kunci }}" name="{{ $nama }}" value="{{ $kunci }}"
                   @checked($nilai === $kunci || (! $nilai && $loop->first))>
            <label for="ikon-{{ $kunci }}">
              <x-ikon :nama="$kunci" />
              {{ $ikon['label'] }}
            </label>
          @endforeach
        </div>

      @elseif ($jenis === 'warna')
        <div class="pilih-warna">
          @foreach (\App\Http\Controllers\Panel\KontenController::WARNA as $kunci => $label)
            <input type="radio" id="warna-{{ $kunci }}" name="{{ $nama }}" value="{{ $kunci }}"
                   @checked($nilai === $kunci || (! $nilai && $loop->first))>
            <label class="warna-{{ $kunci }}" for="warna-{{ $kunci }}">{{ $label }}</label>
          @endforeach
        </div>

      @elseif ($jenis === 'gambar')
        @if ($data->{$nama})
          <div class="pratinjau-gambar">
            <img src="{{ asset('unggahan/'.$data->{$nama}) }}" alt="Gambar {{ $satuan }} saat ini">
            <label class="sakelar" style="margin:0">
              <input type="checkbox" name="hapus_{{ $nama }}" value="1">
              Hapus gambar ini
            </label>
          </div>
        @endif
        <input id="{{ $nama }}" type="file" name="{{ $nama }}" accept=".jpg,.jpeg,.png,.webp"
               @if ($salah) aria-invalid="true" @endif>

      @elseif ($jenis === 'angka')
        <input id="{{ $nama }}" type="number" name="{{ $nama }}" value="{{ $nilai }}"
               @if ($salah) aria-invalid="true" @endif>

      @else
        <input id="{{ $nama }}" type="text" name="{{ $nama }}" value="{{ $nilai }}"
               @if ($salah) aria-invalid="true" @endif>
      @endif

      @if ($errors->has($nama))
        <p class="petunjuk" style="color:var(--tanah)">{{ $errors->first($nama) }}</p>
      @elseif (! empty($m['petunjuk']))
        <p class="petunjuk">{{ $m['petunjuk'] }}</p>
      @endif
    </div>
  @endforeach

  <div class="kaki-borang">
    <button class="tbl-utama" type="submit">Simpan</button>
    <a class="tbl-biasa" href="{{ route("panel.$rute.indeks") }}">Batal</a>

    @unless ($baru)
      <span class="pisah"></span>
      <button class="tbl-bahaya" type="submit"
              form="hapus-{{ $data->id }}">Hapus {{ $satuan }}</button>
    @endunless
  </div>
</form>

@unless ($baru)
  <form id="hapus-{{ $data->id }}" method="POST" action="{{ route("panel.$rute.hapus", $data->id) }}"
        data-konfirmasi="Hapus {{ $satuan }} ini? Tindakan ini tidak bisa dibatalkan.">
    @csrf
    @method('DELETE')
  </form>
@endunless

@endsection
