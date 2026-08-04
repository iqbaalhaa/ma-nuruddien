@extends('layouts.publik')

@section('judul', 'Kontak - MA Nuruddien')
@section('deskripsi', 'Alamat, telepon, email, peta lokasi, dan formulir pesan Madrasah Aliyah Nuruddien Kuala Tungkal.')

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
            <span><strong>Alamat</strong>Jl. Pendidikan No. 12, Kuala Tungkal,<br>Kabupaten Tanjung Jabung Barat, Provinsi Jambi 36513</span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/></svg>
            <span><strong>Telepon</strong><a href="tel:+62742000000">(0742) 000 000</a> &middot; <a href="https://wa.me/6281200000000">WhatsApp 0812-0000-0000</a></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.5" y="4.5" width="19" height="15" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            <span><strong>Email</strong><a href="mailto:info@manuruddien.sch.id">info@manuruddien.sch.id</a></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
            <span><strong>Jam layanan</strong>Senin sampai Sabtu, pukul 07.30 sampai 14.00 WIB</span>
          </li>
        </ul>

        <div class="peta">
          <iframe
            title="Peta lokasi MA Nuruddien di Kuala Tungkal"
            src="https://www.google.com/maps?q=Kuala%20Tungkal%2C%20Tanjung%20Jabung%20Barat%2C%20Jambi&output=embed"
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
        <p class="kecil abu" style="margin-top:12px">Titik peta masih menunjuk area Kuala Tungkal. Ganti koordinatnya dengan lokasi persis madrasah.</p>
      </div>

      <div class="muncul">
        <form class="form" data-form-kontak novalidate>
          <span class="mata">Kirim pesan</span>
          <h2 style="margin-bottom:8px">Ada yang ingin ditanyakan?</h2>
          <p class="kecil abu" style="margin-bottom:26px">Isi kolom di bawah ini. Kami membalas pada jam kerja madrasah.</p>

          <div class="baris">
            <div class="medan">
              <label for="nama">Nama lengkap</label>
              <input id="nama" name="nama" type="text" required autocomplete="name">
              <span class="galat"></span>
            </div>
            <div class="medan">
              <label for="email">Email</label>
              <input id="email" name="email" type="email" required autocomplete="email">
              <span class="galat"></span>
            </div>
          </div>

          <div class="medan">
            <label for="peran">Saya menghubungi sebagai</label>
            <select id="peran" name="peran">
              <option>Calon siswa</option>
              <option>Orang tua atau wali</option>
              <option>Alumni</option>
              <option>Guru atau instansi</option>
              <option>Lainnya</option>
            </select>
          </div>

          <div class="medan">
            <label for="pesan">Pesan</label>
            <textarea id="pesan" name="pesan" required placeholder="Tulis pertanyaan atau pesan Anda di sini."></textarea>
            <span class="galat"></span>
          </div>

          <button class="tbl tbl--isi" type="submit">
            Kirim pesan
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4z"/></svg>
          </button>

          <p class="pesan-sukses" role="status">Terima kasih, pesan Anda sudah tercatat. Kami akan menghubungi Anda kembali.</p>
          <p class="kecil abu" style="margin-top:16px">Formulir ini belum terhubung ke server. Sambungkan ke skrip pengirim email atau basis data saat sistem dijalankan.</p>
        </form>
      </div>
    </div>
  </section>

  <section class="bagian bagian--sage">
    <div class="wrap">
      <div class="kepala-bagian muncul">
        <span class="mata">Buku tamu</span>
        <h2>Pesan yang masuk sebelumnya</h2>
        <p class="utama">Beberapa pesan dari wali murid dan alumni yang ditampilkan atas persetujuan pengirim.</p>
      </div>

      <ul class="tamu kisi kisi--3">
        <li class="muncul">
          <span class="nama">Ibu Rohani</span> &middot; <span class="waktu">Wali murid kelas XI</span>
          <p>Anak saya jadi terbiasa salat duha di rumah karena kebiasaan itu dibawa dari madrasah. Terima kasih, Ustaz dan Ustazah.</p>
        </li>
        <li class="muncul">
          <span class="nama">Fajar Ramadhan</span> &middot; <span class="waktu">Alumni angkatan 2019</span>
          <p>Bekal bahasa Arab dari sini sangat membantu waktu saya masuk perguruan tinggi keagamaan. Semoga madrasah terus berkembang.</p>
        </li>
        <li class="muncul">
          <span class="nama">Bapak Suryadi</span> &middot; <span class="waktu">Calon wali murid</span>
          <p>Kemarin saya berkunjung dan disambut baik. Lingkungannya bersih dan anak-anaknya sopan. Insya Allah anak saya daftar di sini.</p>
        </li>
      </ul>
    </div>
  </section>
</main>
@endsection
