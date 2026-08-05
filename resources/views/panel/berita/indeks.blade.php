@extends('layouts.panel')

@section('judul', 'Berita')

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>Berita &amp; pengumuman</h1>
    <p>Tampil di halaman Berita dan tiga yang terbaru ikut muncul di beranda.</p>
  </div>
  <a class="tbl-utama" href="{{ route('panel.berita.buat') }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
    Tulis berita
  </a>
</div>

<form class="saring" method="GET" action="{{ route('panel.berita.indeks') }}">
  <input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari judul atau ringkasan">

  <select name="kategori">
    <option value="">Semua kategori</option>
    @foreach (\App\Models\Berita::KATEGORI as $kunci => $label)
      <option value="{{ $kunci }}" @selected(request('kategori') === $kunci)>{{ $label }}</option>
    @endforeach
  </select>

  <select name="status">
    <option value="">Semua status</option>
    <option value="terbit" @selected(request('status') === 'terbit')>Tayang</option>
    <option value="draf" @selected(request('status') === 'draf')>Draf</option>
  </select>

  <button class="tbl-utama" type="submit">Saring</button>
  @if (request()->hasAny(['cari', 'kategori', 'status']))
    <a class="tbl-biasa" href="{{ route('panel.berita.indeks') }}">Bersihkan</a>
  @endif
</form>

@if ($berita->isEmpty())
  <div class="tabel-panel-bungkus">
    <div class="kosong">
      <p>Tidak ada berita yang cocok.</p>
      <a class="tbl-utama" href="{{ route('panel.berita.buat') }}">Tulis berita baru</a>
    </div>
  </div>
@else
  <div class="tabel-panel-bungkus">
    <table class="tabel-panel">
      <thead>
        <tr>
          <th style="width:70px">Gambar</th>
          <th>Judul</th>
          <th style="width:120px">Kategori</th>
          <th style="width:120px">Tanggal</th>
          <th style="width:90px">Status</th>
          <th class="kanan" style="width:250px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($berita as $b)
          <tr>
            <td>
              @if ($b->gambar)
                <img class="gambar-kecil" src="{{ asset('unggahan/'.$b->gambar) }}" alt="">
              @else
                <span class="ikon-kecil"><x-ikon :nama="$b->ikon" /></span>
              @endif
            </td>
            <td>
              <strong>{{ $b->judul }}</strong>
              <div class="potong" style="color:var(--abu);font-size:.86rem">{{ Str::limit($b->ringkasan, 90) }}</div>
            </td>
            <td>{{ $b->namaKategori() }}</td>
            <td>{{ $b->tanggal->translatedFormat('j M Y') }}</td>
            <td>
              <span class="pil-status pil-status--{{ $b->terbit ? 'tayang' : 'draf' }}">
                {{ $b->terbit ? 'Tayang' : 'Draf' }}
              </span>
            </td>
            <td>
              <div class="aksi">
                <form method="POST" action="{{ route('panel.berita.terbit', $b) }}">
                  @csrf
                  <button class="tbl-mini" type="submit">{{ $b->terbit ? 'Tarik' : 'Tayangkan' }}</button>
                </form>
                <a class="tbl-mini" href="{{ route('panel.berita.ubah', $b) }}">Ubah</a>
                <form method="POST" action="{{ route('panel.berita.hapus', $b) }}"
                      data-konfirmasi="Hapus berita &quot;{{ $b->judul }}&quot;? Tindakan ini tidak bisa dibatalkan.">
                  @csrf
                  @method('DELETE')
                  <button class="tbl-mini" type="submit">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="halaman">{{ $berita->links() }}</div>
@endif

@endsection
