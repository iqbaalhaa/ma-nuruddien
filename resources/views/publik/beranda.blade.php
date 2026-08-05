@extends('layouts.publik')

@section('judul', 'MA Nuruddien, Madrasah Aliyah di Tanjung Jabung Barat, Jambi')
@section('deskripsi', 'Madrasah Aliyah Nuruddien Kabupaten Tanjung Jabung Barat. Kurikulum terpadu umum dan agama, guru bersertifikasi, dan pembinaan karakter untuk generasi berakhlak, cerdas, dan berprestasi.')
@section('kelas-header', 'header--melayang')

@section('konten')
<main id="utama">

  <!-- ================= HERO ================= -->
  <section class="hero">
    <div class="wrap hero__isi">
      <div class="hero__teks">
        <span class="mata mata--terang">{{ pengaturan('hero_mata') }}</span>
        <h1 class="hero__jargon">{!! sorotan(pengaturan('hero_judul')) !!}</h1>
        <p class="utama">{{ pengaturan('hero_teks') }}</p>
        <div class="hero__aksi">
          <a class="tbl tbl--emas" href="{{ route('profil') }}">
            Kenali madrasah kami
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a class="tbl tbl--terang" href="{{ route('akademik') }}">Lihat program akademik</a>
        </div>
        <p class="hero__catatan">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
          {{ pengaturan('peta') }}
          @if (pengaturan('hero_catatan'))
            <span class="hero__pemisah" aria-hidden="true"></span>
            {{ pengaturan('hero_catatan') }}
          @endif
        </p>
      </div>
    </div>
  </section>

  <!-- ================= KEUNGGULAN ================= -->
  <section class="bagian bagian--sage">
    <div class="wrap">
      <div class="kepala-bagian kepala-bagian--tengah muncul">
        <span class="mata">Kenapa {{ pengaturan('nama_pendek') }}</span>
        <h2>{{ pengaturan('beranda_keunggulan_judul') }}</h2>
        <p class="utama">{{ pengaturan('beranda_keunggulan_teks') }}</p>
      </div>

      <div class="kisi kisi--3">
        @foreach ($keunggulan as $k)
          <article class="kartu muncul">
            <div class="kartu__ikon"><x-ikon :nama="$k->ikon" /></div>
            <h3>{{ $k->judul }}</h3>
            <p>{{ $k->keterangan }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ================= STATISTIK ================= -->
  <section class="bagian--gelap" aria-label="Madrasah dalam angka">
    <div class="statistik">
      @foreach ([
          'statistik_siswa' => 'Siswa aktif',
          'statistik_guru' => 'Guru & staf',
          'statistik_ekskul' => 'Ekstrakurikuler',
          'statistik_tahun' => 'Tahun mengabdi',
      ] as $kunci => $label)
        @php $angka = (int) pengaturan($kunci, '0'); @endphp
        <div class="statistik__sel">
          <span class="statistik__angka" data-hitung="{{ $angka }}" data-akhiran="">{{ $angka }}</span>
          <span class="statistik__label">{{ $label }}</span>
        </div>
      @endforeach
    </div>
  </section>

  <!-- ================= SEKILAS PROFIL ================= -->
  <section class="bagian">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Sekilas madrasah</span>
        <h2>{{ pengaturan('beranda_sekilas_judul') }}</h2>
        <p class="utama">{{ pengaturan('beranda_sekilas_1') }}</p>
        <p>{{ pengaturan('beranda_sekilas_2') }}</p>
        <a class="tautan-panah" href="{{ route('profil') }}">Baca profil lengkap <span aria-hidden="true">&rarr;</span></a>
      </div>

      <aside class="kotak-info muncul">
        <h3>Identitas madrasah</h3>
        <ul>
          <li><strong>Nama:</strong> {{ pengaturan('nama_madrasah') }}</li>
          <li><strong>Jenjang:</strong> {{ pengaturan('identitas_jenjang') }}</li>
          <li><strong>Status:</strong> {{ pengaturan('identitas_status') }}</li>
          <li><strong>Akreditasi:</strong> {{ pengaturan('identitas_akreditasi') }}</li>
          <li><strong>Peminatan:</strong> {{ \App\Models\Peminatan::urut()->pluck('kode')->join(', ', ', dan ') }}</li>
          <li><strong>Lokasi:</strong> {{ pengaturan('peta') }}</li>
        </ul>
      </aside>
    </div>
  </section>

  <!-- ================= KUTIPAN KEPALA MADRASAH ================= -->
  <section class="bagian bagian--sage">
    <div class="wrap">
      <figure class="kutipan muncul">
        <div class="kutipan__foto">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a7 7 0 0 1 7-7h2a7 7 0 0 1 7 7v1"/></svg>
        </div>
        <div>
          <svg class="bintang" viewBox="0 0 44 44" aria-hidden="true" style="margin:0 0 18px"><rect x="9" y="9" width="26" height="26"/><rect x="9" y="9" width="26" height="26" transform="rotate(45 22 22)"/></svg>
          <blockquote>
            &ldquo;{{ pengaturan('kepala_kutipan_beranda') }}&rdquo;
          </blockquote>
          <figcaption>
            <strong>{{ pengaturan('kepala_nama') }}</strong>
            Kepala {{ pengaturan('nama_madrasah') }}
          </figcaption>
        </div>
      </figure>
    </div>
  </section>

  <!-- ================= BERITA TERBARU ================= -->
  <section class="bagian">
    <div class="wrap">
      <div class="alat muncul">
        <div class="kepala-bagian" style="margin-bottom:0">
          <span class="mata">Kabar madrasah</span>
          <h2 style="margin-bottom:0">Berita terbaru</h2>
        </div>
        <a class="tautan-panah" href="{{ route('berita') }}">Lihat semua kabar <span aria-hidden="true">&rarr;</span></a>
      </div>

      <div class="berita">
        @forelse ($berita as $b)
          <article class="berita__item muncul">
            <div class="berita__gambar berita__gambar--{{ $b->warna }}">
              <span class="berita__label">{{ $b->namaKategori() }}</span>
              @if ($b->gambar)
                <img src="{{ asset('unggahan/'.$b->gambar) }}" alt="{{ $b->judul }}" loading="lazy">
              @else
                <x-ikon :nama="$b->ikon" tebal="1.5" />
              @endif
            </div>
            <div class="berita__teks">
              <span class="berita__tanggal">{{ $b->tanggal->translatedFormat('j F Y') }}</span>
              <h3><a href="{{ route('berita.baca', $b) }}">{{ $b->judul }}</a></h3>
              <p>{{ $b->ringkasan }}</p>
              <a class="tautan-panah" href="{{ route('berita.baca', $b) }}">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
            </div>
          </article>
        @empty
          <p class="abu">Belum ada berita yang diterbitkan.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ================= FASILITAS RINGKAS ================= -->
  <section class="bagian bagian--sage">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Ruang belajar</span>
        <h2>Fasilitas yang dipakai setiap hari</h2>
        <p class="utama">Kondisinya sederhana dan terawat. Semuanya dipakai untuk kegiatan belajar siswa.</p>
      </div>

      <div class="kisi kisi--4">
        @foreach ($fasilitas as $fs)
          <div class="lengkung muncul" style="cursor:default">
            <div class="lengkung__gambar lengkung__gambar--{{ $fs->warna }}">
              @if ($fs->gambar)
                <img src="{{ asset('unggahan/'.$fs->gambar) }}" alt="{{ $fs->nama }}" loading="lazy">
              @else
                <x-ikon :nama="$fs->ikon" tebal="1.5" />
              @endif
            </div>
            <div class="lengkung__teks"><h3>{{ $fs->nama }}</h3><p>{{ $fs->ringkas }}</p></div>
          </div>
        @endforeach
      </div>
      <p style="margin-top:34px"><a class="tautan-panah" href="{{ route('fasilitas') }}">Lihat seluruh fasilitas <span aria-hidden="true">&rarr;</span></a></p>
    </div>
  </section>

  <!-- ================= AJAKAN ================= -->
  <section class="ajakan">
    <div class="wrap ajakan__isi">
      <svg class="bintang" viewBox="0 0 44 44" aria-hidden="true" style="margin-bottom:20px"><rect x="9" y="9" width="26" height="26" style="stroke:#e8d29a"/><rect x="9" y="9" width="26" height="26" transform="rotate(45 22 22)" style="stroke:#e8d29a"/></svg>
      <h2>Ingin tahu lebih banyak tentang MA Nuruddien?</h2>
      <p>Datang langsung ke madrasah, atau kirim pertanyaan lewat halaman kontak. Kami senang berbincang dengan calon siswa maupun orang tua.</p>
      <div class="ajakan__aksi">
        <a class="tbl tbl--emas" href="{{ route('kontak') }}">Hubungi kami</a>
        <a class="tbl tbl--terang" href="{{ route('fasilitas') }}">Lihat galeri kegiatan</a>
      </div>
    </div>
  </section>

</main>
@endsection
