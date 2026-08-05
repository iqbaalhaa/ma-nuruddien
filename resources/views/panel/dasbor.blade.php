@extends('layouts.panel')

@section('judul', 'Dasbor')

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>Dasbor</h1>
    <p>Selamat datang, {{ auth()->user()->name }}. Seluruh isi situs madrasah dikelola dari menu di sebelah kiri.</p>
  </div>
  <a class="tbl-utama" href="{{ route('panel.berita.buat') }}">Tulis berita</a>
</div>

@if ($pesanBelumDibaca || $tamuMenunggu || $beritaDraf)
  <div class="kabar">
    Perlu perhatian:
    @if ($pesanBelumDibaca)
      <a href="{{ route('panel.pesan.indeks', ['saring' => 'belum']) }}">{{ $pesanBelumDibaca }} pesan belum dibaca</a>.
    @endif
    @if ($tamuMenunggu)
      <a href="{{ route('panel.tamu.indeks') }}">{{ $tamuMenunggu }} kiriman buku tamu menunggu persetujuan</a>.
    @endif
    @if ($beritaDraf)
      <a href="{{ route('panel.berita.indeks', ['status' => 'draf']) }}">{{ $beritaDraf }} berita masih draf</a>.
    @endif
  </div>
@endif

<div class="kisi-panel" style="margin-top:0">
  <div class="kartu-panel">
    <span class="angka-panel">{{ $jumlahBerita }}</span>
    <span class="label-panel">Berita</span>
  </div>
  <div class="kartu-panel">
    <span class="angka-panel">{{ $jumlahPrestasi }}</span>
    <span class="label-panel">Prestasi</span>
  </div>
  <div class="kartu-panel">
    <span class="angka-panel">{{ $jumlahFasilitas }}</span>
    <span class="label-panel">Sarana belajar</span>
  </div>
  <div class="kartu-panel">
    <span class="angka-panel">{{ $jumlahGaleri }}</span>
    <span class="label-panel">Galeri kegiatan</span>
  </div>
</div>

<div class="kisi-panel" style="grid-template-columns:repeat(auto-fit,minmax(320px,1fr))">

  <section class="kartu-panel">
    <h2 style="font-size:1.1rem">Berita terakhir</h2>
    @if ($beritaTerakhir->isEmpty())
      <p style="color:var(--abu);font-size:.92rem">Belum ada berita.</p>
    @else
      <ul style="list-style:none;margin:16px 0 0;padding:0;display:grid;gap:12px">
        @foreach ($beritaTerakhir as $b)
          <li style="display:flex;gap:12px;align-items:baseline">
            <span class="pil-status pil-status--{{ $b->terbit ? 'tayang' : 'draf' }}">{{ $b->terbit ? 'Tayang' : 'Draf' }}</span>
            <a href="{{ route('panel.berita.ubah', $b) }}" style="flex:1">{{ Str::limit($b->judul, 60) }}</a>
            <span style="color:var(--abu);font-size:.82rem;white-space:nowrap">{{ $b->tanggal->translatedFormat('j M') }}</span>
          </li>
        @endforeach
      </ul>
    @endif
  </section>

  <section class="kartu-panel">
    <h2 style="font-size:1.1rem">Pesan terakhir</h2>
    @if ($pesanTerakhir->isEmpty())
      <p style="color:var(--abu);font-size:.92rem">Belum ada pesan dari pengunjung.</p>
    @else
      <ul style="list-style:none;margin:16px 0 0;padding:0;display:grid;gap:12px">
        @foreach ($pesanTerakhir as $p)
          <li>
            <strong style="font-size:.94rem">{{ $p->nama }}</strong>
            <span style="color:var(--abu);font-size:.82rem"> · {{ $p->created_at->diffForHumans() }}</span>
            <div style="color:var(--ink-soft);font-size:.9rem">{{ Str::limit($p->pesan, 80) }}</div>
          </li>
        @endforeach
      </ul>
      <p style="margin:18px 0 0"><a class="tbl-mini" href="{{ route('panel.pesan.indeks') }}">Buka kotak masuk</a></p>
    @endif
  </section>

</div>

@endsection
