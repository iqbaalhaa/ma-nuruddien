@extends('layouts.publik')

@section('judul', 'Kontak - '.pengaturan('nama_pendek'))
@section('deskripsi', 'Alamat, telepon, email, peta lokasi, dan formulir pesan '.pengaturan('nama_madrasah').'.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Kontak</p>
      <h1>Hubungi Madrasah</h1>
      <p>Datang langsung, telepon, atau kirim pesan. Pertanyaan dari calon siswa dan orang tua selalu kami jawab.</p>
    </div>
  </section>

  <section class="bagian">
    <div class="wrap kontak-kisi">
      <div class="muncul">
        <span class="mata">Informasi kontak</span>
        <h2>Cara menghubungi kami</h2>

        <ul class="kontak-daftar">
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            <span><strong>Alamat</strong>{!! nl2br(e(pengaturan('alamat'))) !!}</span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/></svg>
            <span>
              <strong>Telepon</strong>
              <a href="tel:{{ preg_replace('~\D~', '', pengaturan('telepon')) }}">{{ pengaturan('telepon') }}</a>
              @if (pengaturan('whatsapp'))
                &middot;
                <a href="https://wa.me/{{ preg_replace('~^0~', '62', preg_replace('~\D~', '', pengaturan('whatsapp'))) }}">WhatsApp {{ pengaturan('whatsapp') }}</a>
              @endif
            </span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.5" y="4.5" width="19" height="15" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            <span><strong>Email</strong><a href="mailto:{{ pengaturan('email') }}">{{ pengaturan('email') }}</a></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
            <span><strong>Jam layanan</strong>{{ pengaturan('jam_layanan') }}</span>
          </li>
        </ul>

        <div class="peta">
          <iframe
            title="Peta lokasi {{ pengaturan('nama_pendek') }}"
            src="https://www.google.com/maps?q={{ urlencode(pengaturan('peta')) }}&output=embed"
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
      </div>

      <div class="muncul" id="kirim-pesan">
        <form class="form" method="POST" action="{{ route('kontak.pesan') }}">
          @csrf
          <span class="mata">Kirim pesan</span>
          <h2 style="margin-bottom:8px">Ada yang ingin ditanyakan?</h2>
          <p class="kecil abu" style="margin-bottom:26px">Isi kolom di bawah ini. Kami membalas pada jam kerja madrasah.</p>

          @if (session('kabarKontak'))
            <p class="pesan-sukses" role="status" style="display:block">{{ session('kabarKontak') }}</p>
          @endif

          <div class="baris">
            <div class="medan">
              <label for="nama">Nama lengkap</label>
              <input id="nama" name="nama" type="text" value="{{ old('nama') }}" required autocomplete="name">
              @error('nama')<span class="galat" style="display:block">{{ $message }}</span>@enderror
            </div>
            <div class="medan">
              <label for="email">Email</label>
              <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')<span class="galat" style="display:block">{{ $message }}</span>@enderror
            </div>
          </div>

          <div class="medan">
            <label for="peran">Saya menghubungi sebagai</label>
            <select id="peran" name="peran">
              @foreach (['Calon siswa', 'Orang tua atau wali', 'Alumni', 'Guru atau instansi', 'Lainnya'] as $pilihan)
                <option @selected(old('peran') === $pilihan)>{{ $pilihan }}</option>
              @endforeach
            </select>
          </div>

          <div class="medan">
            <label for="pesan">Pesan</label>
            <textarea id="pesan" name="pesan" required placeholder="Tulis pertanyaan atau pesan Anda di sini.">{{ old('pesan') }}</textarea>
            @error('pesan')<span class="galat" style="display:block">{{ $message }}</span>@enderror
          </div>

          {{-- Kolom jebakan untuk robot pengirim spam. Manusia tidak melihatnya. --}}
          <div style="position:absolute;left:-9999px" aria-hidden="true">
            <label for="jebakan">Biarkan kosong</label>
            <input id="jebakan" type="text" name="jebakan" tabindex="-1" autocomplete="off">
          </div>

          <button class="tbl tbl--isi" type="submit">
            Kirim pesan
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4z"/></svg>
          </button>
        </form>
      </div>
    </div>
  </section>

  <section class="bagian bagian--sage" id="buku-tamu">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Buku tamu</span>
        <h2>Pesan dari wali murid dan alumni</h2>
        <p class="utama">Ditampilkan atas persetujuan pengirim dan setelah diperiksa pengelola madrasah.</p>
      </div>

      @if (session('kabarTamu'))
        <p class="pesan-sukses" role="status" style="display:block;margin-bottom:24px">{{ session('kabarTamu') }}</p>
      @endif

      @if ($tamu->isNotEmpty())
        <ul class="tamu kisi kisi--3">
          @foreach ($tamu as $t)
            <li class="muncul">
              <span class="nama">{{ $t->nama }}</span>
              @if ($t->peran)
                &middot; <span class="waktu">{{ $t->peran }}</span>
              @endif
              <p>{{ $t->pesan }}</p>
            </li>
          @endforeach
        </ul>
      @else
        <p class="abu">Belum ada pesan yang ditampilkan. Jadilah yang pertama menulis di bawah ini.</p>
      @endif

      <form class="form" method="POST" action="{{ route('kontak.tamu') }}" style="margin-top:34px;max-width:640px">
        @csrf
        <h3 style="margin-bottom:8px">Tulis pesan di buku tamu</h3>
        <p class="kecil abu" style="margin-bottom:22px">Pesan tampil setelah diperiksa pengelola madrasah.</p>

        <div class="baris">
          <div class="medan">
            <label for="tamu-nama">Nama</label>
            <input id="tamu-nama" name="nama" type="text" value="{{ old('nama') }}" required>
          </div>
          <div class="medan">
            <label for="tamu-peran">Anda adalah</label>
            <input id="tamu-peran" name="peran" type="text" value="{{ old('peran') }}" placeholder="Wali murid kelas XI">
          </div>
        </div>

        <div class="medan">
          <label for="tamu-pesan">Pesan</label>
          <textarea id="tamu-pesan" name="pesan" required>{{ old('pesan') }}</textarea>
        </div>

        <div style="position:absolute;left:-9999px" aria-hidden="true">
          <label for="tamu-jebakan">Biarkan kosong</label>
          <input id="tamu-jebakan" type="text" name="jebakan" tabindex="-1" autocomplete="off">
        </div>

        <button class="tbl tbl--isi" type="submit">Kirim ke buku tamu</button>
      </form>
    </div>
  </section>
</main>
@endsection
