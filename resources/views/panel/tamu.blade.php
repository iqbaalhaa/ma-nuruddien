@extends('layouts.panel')

@section('judul', 'Buku tamu')

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>Buku tamu</h1>
    <p>Kiriman pengunjung baru tampil di halaman Kontak setelah Anda setujui.
       @if ($menunggu) <strong>{{ $menunggu }} menunggu persetujuan.</strong> @endif</p>
  </div>
</div>

@if ($tamu->isEmpty())
  <div class="tabel-panel-bungkus">
    <div class="kosong"><p>Belum ada kiriman buku tamu.</p></div>
  </div>
@else
  @foreach ($tamu as $t)
    <article class="pesan-baris @if (! $t->tampil) pesan-baris--baru @endif">
      <div class="pesan-kepala">
        <strong>{{ $t->nama }}</strong>
        @if ($t->peran)
          <span style="color:var(--abu);font-size:.88rem">{{ $t->peran }}</span>
        @endif
        <span class="pil-status pil-status--{{ $t->tampil ? 'tayang' : 'draf' }}">
          {{ $t->tampil ? 'Tampil di situs' : 'Menunggu' }}
        </span>
        <span class="waktu">{{ $t->created_at->translatedFormat('j M Y, H:i') }}</span>
      </div>

      <p class="pesan-isi">{{ $t->pesan }}</p>

      <div class="pesan-aksi">
        <form method="POST" action="{{ route('panel.tamu.alih', $t) }}">
          @csrf
          <button class="tbl-mini" type="submit">{{ $t->tampil ? 'Sembunyikan' : 'Setujui dan tampilkan' }}</button>
        </form>
        <form method="POST" action="{{ route('panel.tamu.hapus', $t) }}"
              data-konfirmasi="Hapus kiriman dari {{ $t->nama }}? Tindakan ini tidak bisa dibatalkan.">
          @csrf
          @method('DELETE')
          <button class="tbl-mini" type="submit">Hapus</button>
        </form>
      </div>
    </article>
  @endforeach

  <div class="halaman">{{ $tamu->links() }}</div>
@endif

@endsection
