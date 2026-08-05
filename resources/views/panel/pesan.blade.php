@extends('layouts.panel')

@section('judul', 'Pesan masuk')

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>Pesan masuk</h1>
    <p>Kiriman dari formulir kontak. Isinya tidak pernah tampil di situs.</p>
  </div>
</div>

<nav class="tab-pengaturan" aria-label="Saring pesan">
  <a href="{{ route('panel.pesan.indeks') }}" @if ($saring !== 'belum') aria-current="page" @endif>
    Semua
  </a>
  <a href="{{ route('panel.pesan.indeks', ['saring' => 'belum']) }}" @if ($saring === 'belum') aria-current="page" @endif>
    Belum dibaca @if ($belumDibaca) ({{ $belumDibaca }}) @endif
  </a>
</nav>

@if ($pesan->isEmpty())
  <div class="tabel-panel-bungkus">
    <div class="kosong"><p>Belum ada pesan masuk.</p></div>
  </div>
@else
  @foreach ($pesan as $p)
    <article class="pesan-baris @if (! $p->dibaca) pesan-baris--baru @endif">
      <div class="pesan-kepala">
        <strong>{{ $p->nama }}</strong>
        @if ($p->peran)
          <span class="pil-status pil-status--tayang">{{ $p->peran }}</span>
        @endif
        @unless ($p->dibaca)
          <span class="pil-status pil-status--baru">Baru</span>
        @endunless
        <span class="waktu">{{ $p->created_at->translatedFormat('j M Y, H:i') }}</span>
      </div>

      <p class="pesan-isi">{{ $p->pesan }}</p>

      <div class="pesan-aksi">
        <a class="tbl-mini" href="mailto:{{ $p->email }}?subject={{ rawurlencode('Balasan dari MA Nuruddien') }}">
          Balas ke {{ $p->email }}
        </a>
        <form method="POST" action="{{ route('panel.pesan.baca', $p) }}">
          @csrf
          <button class="tbl-mini" type="submit">{{ $p->dibaca ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}</button>
        </form>
        <form method="POST" action="{{ route('panel.pesan.hapus', $p) }}"
              data-konfirmasi="Hapus pesan dari {{ $p->nama }}? Tindakan ini tidak bisa dibatalkan.">
          @csrf
          @method('DELETE')
          <button class="tbl-mini" type="submit">Hapus</button>
        </form>
      </div>
    </article>
  @endforeach

  <div class="halaman">{{ $pesan->links() }}</div>
@endif

@endsection
