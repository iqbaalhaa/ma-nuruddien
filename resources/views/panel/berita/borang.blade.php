@extends('layouts.panel')

@section('judul', $baru ? 'Tulis berita' : 'Ubah berita')

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>{{ $baru ? 'Tulis berita' : 'Ubah berita' }}</h1>
    @unless ($baru)
      <p>Alamat di situs: <code>/berita/{{ $berita->slug }}</code></p>
    @endunless
  </div>
  <a class="tbl-biasa" href="{{ route('panel.berita.indeks') }}">Kembali ke daftar</a>
</div>

<form class="borang-panel" method="POST" action="{{ $aksi }}" enctype="multipart/form-data">
  @csrf
  @unless ($baru)
    @method('PUT')
  @endunless

  <div class="medan">
    <label for="judul">Judul berita</label>
    <input id="judul" type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
           @error('judul') aria-invalid="true" @enderror>
    @error('judul')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="baris-borang">
    <div class="medan">
      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori">
        @foreach (\App\Models\Berita::KATEGORI as $kunci => $label)
          <option value="{{ $kunci }}" @selected(old('kategori', $berita->kategori) === $kunci)>{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div class="medan">
      <label for="tanggal">Tanggal terbit</label>
      <input id="tanggal" type="date" name="tanggal"
             value="{{ old('tanggal', $berita->tanggal?->format('Y-m-d')) }}"
             @error('tanggal') aria-invalid="true" @enderror>
      <p class="petunjuk">Tanggal di masa depan membuat berita belum tampil di situs.</p>
    </div>
  </div>

  <div class="medan">
    <label for="ringkasan">Ringkasan</label>
    <textarea id="ringkasan" name="ringkasan" @error('ringkasan') aria-invalid="true" @enderror>{{ old('ringkasan', $berita->ringkasan) }}</textarea>
    <p class="petunjuk">Dua sampai tiga kalimat. Inilah yang terbaca di daftar berita dan di beranda.</p>
    @error('ringkasan')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="medan">
    <label for="isi">Isi berita</label>
    <textarea id="isi" class="tinggi" name="isi" @error('isi') aria-invalid="true" @enderror>{{ old('isi', $berita->isi) }}</textarea>
    <p class="petunjuk">Tulis biasa saja. Baris kosong akan jadi paragraf baru di halaman berita.</p>
    @error('isi')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="medan">
    <label for="gambar">Foto berita</label>
    @if ($berita->gambar)
      <div class="pratinjau-gambar">
        <img src="{{ asset('unggahan/'.$berita->gambar) }}" alt="Foto berita saat ini">
        <label class="sakelar" style="margin:0">
          <input type="checkbox" name="hapus_gambar" value="1">
          Hapus foto ini
        </label>
      </div>
    @endif
    <input id="gambar" type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp"
           @error('gambar') aria-invalid="true" @enderror>
    <p class="petunjuk">JPG, PNG, atau WEBP, paling besar 3 MB. Boleh dikosongkan, nanti dipakai ikon di bawah.</p>
    @error('gambar')<p class="petunjuk" style="color:var(--tanah)">{{ $message }}</p>@enderror
  </div>

  <div class="medan">
    <label>Ikon pengganti bila tidak ada foto</label>
    <div class="pilih-ikon">
      @foreach (config('ikon') as $kunci => $ikon)
        <input type="radio" id="ikon-{{ $kunci }}" name="ikon" value="{{ $kunci }}"
               @checked(old('ikon', $berita->ikon ?: 'wisuda') === $kunci)>
        <label for="ikon-{{ $kunci }}">
          <x-ikon :nama="$kunci" />
          {{ $ikon['label'] }}
        </label>
      @endforeach
    </div>
  </div>

  <div class="medan">
    <label>Warna kartu</label>
    <div class="pilih-warna">
      @foreach (\App\Http\Controllers\Panel\KontenController::WARNA as $kunci => $label)
        <input type="radio" id="warna-{{ $kunci }}" name="warna" value="{{ $kunci }}"
               @checked(old('warna', $berita->warna ?: 'pucuk') === $kunci)>
        <label class="warna-{{ $kunci }}" for="warna-{{ $kunci }}">{{ $label }}</label>
      @endforeach
    </div>
  </div>

  <div class="medan">
    <label class="sakelar">
      <input type="checkbox" name="terbit" value="1" @checked(old('terbit', $berita->terbit))>
      Tayangkan di situs
    </label>
    <p class="petunjuk">Kalau tidak dicentang, berita tersimpan sebagai draf dan tidak terlihat pengunjung.</p>
  </div>

  <div class="kaki-borang">
    <button class="tbl-utama" type="submit">Simpan berita</button>
    <a class="tbl-biasa" href="{{ route('panel.berita.indeks') }}">Batal</a>
    @unless ($baru)
      <span class="pisah"></span>
      <button class="tbl-bahaya" type="submit" form="hapus-berita">Hapus berita</button>
    @endunless
  </div>
</form>

@unless ($baru)
  <form id="hapus-berita" method="POST" action="{{ route('panel.berita.hapus', $berita) }}"
        data-konfirmasi="Hapus berita ini? Tindakan ini tidak bisa dibatalkan.">
    @csrf
    @method('DELETE')
  </form>
@endunless

@endsection
