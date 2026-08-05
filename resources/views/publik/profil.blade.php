@extends('layouts.publik')

@section('judul', 'Profil - '.pengaturan('nama_pendek'))
@section('deskripsi', 'Sejarah, visi dan misi, struktur organisasi, serta sambutan kepala '.pengaturan('nama_madrasah').'.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Profil</p>
      <h1>Profil {{ pengaturan('nama_madrasah') }}</h1>
      <p>Perjalanan, arah, dan orang-orang yang menjalankan madrasah ini dari hari ke hari.</p>
    </div>
  </section>

  <nav class="subnav" aria-label="Bagian halaman"><div class="wrap"><ul class="subnav__daftar"><li><a href="#sejarah">Sejarah</a></li><li><a href="#visi-misi">Visi & misi</a></li><li><a href="#struktur">Struktur organisasi</a></li><li><a href="#sambutan">Sambutan kepala</a></li></ul></div></nav>

  <section class="bagian" id="sejarah">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Sejarah</span>
        <h2>{{ pengaturan('profil_sejarah_judul') }}</h2>
        <p class="utama">{{ pengaturan('profil_sejarah_1') }}</p>
        <p>{{ pengaturan('profil_sejarah_2') }}</p>
      </div>

      <ol class="linimasa muncul">
        @foreach ($linimasa as $l)
          <li><span class="tahun">{{ $l->tahun }}</span><p>{{ $l->peristiwa }}</p></li>
        @endforeach
      </ol>
    </div>
  </section>

  <section class="bagian bagian--sage" id="visi-misi">
    <div class="wrap duo duo--balik">
      <div class="visi muncul">
        <span class="mata mata--terang">Visi</span>
        <p class="visi__kalimat">{{ pengaturan('visi') }}</p>
      </div>

      <div class="muncul">
        <span class="mata">Misi</span>
        <h2>{{ ucfirst(\Illuminate\Support\Number::spell($misi->count(), locale: 'id')) }} langkah yang kami tempuh</h2>
        <ol class="misi">
          @foreach ($misi as $m)
            <li>{{ $m->isi }}</li>
          @endforeach
        </ol>
      </div>
    </div>
  </section>

  <section class="bagian" id="struktur">
    <div class="wrap">
      <div class="kepala-bagian kepala-bagian--tengah muncul">
        <span class="mata">Struktur organisasi</span>
        <h2>Siapa mengerjakan apa</h2>
        <p class="utama">Susunan pengelola madrasah pada tahun ajaran {{ pengaturan('tahun_ajaran') }}.</p>
      </div>

      <div class="struktur muncul">
        @php
          $gaya = [
              1 => ['kelas' => '', 'gaya' => 'max-width:340px;margin-inline:auto'],
              2 => ['kelas' => 'kisi--2', 'gaya' => 'max-width:720px;margin-inline:auto'],
              3 => ['kelas' => 'kisi--4', 'gaya' => ''],
              4 => ['kelas' => 'kisi--3', 'gaya' => ''],
          ];
        @endphp

        @foreach ($gaya as $baris => $atur)
          @continue(! isset($pengurus[$baris]))
          <div class="struktur__baris {{ $atur['kelas'] }}" @if ($atur['gaya']) style="{{ $atur['gaya'] }}" @endif>
            @foreach ($pengurus[$baris] as $p)
              <div class="struktur__sel @if ($baris === 1) struktur__sel--puncak @endif">
                <strong>{{ $p->nama }}</strong>
                <span>{{ $p->jabatan }}</span>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bagian bagian--sage" id="sambutan">
    <div class="wrap">
      <figure class="kutipan muncul">
        <div class="kutipan__foto">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a7 7 0 0 1 7-7h2a7 7 0 0 1 7 7v1"/></svg>
        </div>
        <div>
          <span class="mata">Sambutan kepala madrasah</span>
          <blockquote>&ldquo;{{ pengaturan('kepala_sambutan') }}&rdquo;</blockquote>
          <p style="margin-top:18px;font-size:0.98rem;color:var(--ink-soft)">{{ pengaturan('kepala_sambutan_lanjut') }}</p>
          <figcaption>
            <strong>{{ pengaturan('kepala_nama') }}</strong>
            Kepala {{ pengaturan('nama_madrasah') }}
          </figcaption>
        </div>
      </figure>
    </div>
  </section>
</main>
@endsection
