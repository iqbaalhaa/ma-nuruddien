@extends('layouts.panel')

@section('judul', $judul)

@section('konten')

<div class="kepala-panel">
  <div>
    <h1>{{ $judul }}</h1>
    @if ($catatan)
      <p>{{ $catatan }}</p>
    @endif
  </div>
  <a class="tbl-utama" href="{{ route("panel.$rute.buat") }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
    Tambah {{ $satuan }}
  </a>
</div>

@if ($baris->isEmpty())
  <div class="tabel-panel-bungkus">
    <div class="kosong">
      <p>Belum ada {{ $satuan }} yang tersimpan.</p>
      <a class="tbl-utama" href="{{ route("panel.$rute.buat") }}">Tambah {{ $satuan }} pertama</a>
    </div>
  </div>
@else
  <div class="tabel-panel-bungkus">
    <table class="tabel-panel">
      <thead>
        <tr>
          @php $adaGambar = collect($medan)->contains(fn ($m) => ($m['jenis'] ?? '') === 'gambar'); @endphp
          @if ($adaGambar || collect($medan)->contains(fn ($m) => ($m['jenis'] ?? '') === 'ikon'))
            <th style="width:70px">Tampilan</th>
          @endif
          @foreach ($medan as $m)
            @if (($m['daftar'] ?? false))
              <th>{{ $m['label'] }}</th>
            @endif
          @endforeach
          <th class="kanan" style="width:250px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($baris as $b)
          <tr>
            @if ($adaGambar || collect($medan)->contains(fn ($m) => ($m['jenis'] ?? '') === 'ikon'))
              <td>
                @if ($adaGambar && $b->gambar)
                  <img class="gambar-kecil" src="{{ asset('unggahan/'.$b->gambar) }}" alt="">
                @elseif (isset($b->ikon))
                  <span class="ikon-kecil"><x-ikon :nama="$b->ikon" /></span>
                @endif
              </td>
            @endif

            @foreach ($medan as $m)
              @continue(! ($m['daftar'] ?? false))
              <td class="{{ ($m['jenis'] ?? '') === 'panjang' ? 'potong' : '' }}">
                @if (($m['jenis'] ?? '') === 'pilih')
                  {{ $m['pilihan'][$b->{$m['nama']}] ?? $b->{$m['nama']} }}
                @else
                  {{ Str::limit($b->{$m['nama']}, 120) }}
                @endif
              </td>
            @endforeach

            <td>
              <div class="aksi">
                <div class="urut">
                  <form method="POST" action="{{ route("panel.$rute.geser", $b->id) }}">
                    @csrf
                    <input type="hidden" name="arah" value="naik">
                    <button class="tbl-mini" type="submit" title="Naikkan" @disabled($loop->first)>&uarr;</button>
                  </form>
                  <form method="POST" action="{{ route("panel.$rute.geser", $b->id) }}">
                    @csrf
                    <input type="hidden" name="arah" value="turun">
                    <button class="tbl-mini" type="submit" title="Turunkan" @disabled($loop->last)>&darr;</button>
                  </form>
                </div>
                <a class="tbl-mini" href="{{ route("panel.$rute.ubah", $b->id) }}">Ubah</a>
                <form method="POST" action="{{ route("panel.$rute.hapus", $b->id) }}"
                      data-konfirmasi="Hapus {{ $satuan }} ini? Tindakan ini tidak bisa dibatalkan.">
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

  <p class="petunjuk" style="margin-top:14px;color:var(--abu);font-size:.86rem">
    Panah atas dan bawah mengatur urutan tampil di halaman publik.
  </p>
@endif

@endsection
