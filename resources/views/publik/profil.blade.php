@extends('layouts.publik')

@section('judul', 'Profil - MA Nuruddien')
@section('deskripsi', 'Sejarah, visi dan misi, struktur organisasi, serta sambutan kepala Madrasah Aliyah Nuruddien Tanjung Jabung Barat.')

@section('konten')
<main id="utama">
  <section class="judul-halaman">
    <div class="wrap judul-halaman__isi">
      <p class="remah"><a href="{{ route('beranda') }}">Beranda</a> &nbsp;/&nbsp; Profil</p>
      <h1>Profil Madrasah Aliyah Nuruddien</h1>
      <p>Perjalanan, arah, dan orang-orang yang menjalankan madrasah ini dari hari ke hari.</p>
    </div>
  </section>
  <nav class="subnav" aria-label="Bagian halaman"><div class="wrap"><ul class="subnav__daftar"><li><a href="#sejarah">Sejarah</a></li><li><a href="#visi-misi">Visi & misi</a></li><li><a href="#struktur">Struktur organisasi</a></li><li><a href="#sambutan">Sambutan kepala</a></li></ul></div></nav>

  <section class="bagian" id="sejarah">
    <div class="wrap duo">
      <div class="muncul">
        <span class="mata">Sejarah</span>
        <h2>Berawal dari satu ruang kelas pinjaman</h2>
        <p class="utama">
          MA Nuruddien lahir dari keresahan sederhana warga Kuala Tungkal: lulusan madrasah
          tsanawiyah setempat harus menempuh perjalanan jauh untuk melanjutkan sekolah menengah
          atas berbasis keagamaan. Beberapa tokoh masyarakat lalu bersepakat mendirikan madrasah
          aliyah sendiri.
        </p>
        <p>
          Tahun pertama hanya ada satu rombongan belajar dengan meja seadanya. Dari sana,
          madrasah tumbuh perlahan mengikuti kemampuan yayasan dan dukungan wali murid, sampai
          memiliki gedung, laboratorium, dan perpustakaannya sendiri.
        </p>
      </div>

      <ol class="linimasa muncul">
        <li><span class="tahun">2003</span><p>Madrasah didirikan oleh Yayasan Nuruddien dengan satu rombongan belajar dan enam tenaga pengajar.</p></li>
        <li><span class="tahun">2008</span><p>Gedung permanen tiga ruang kelas selesai dibangun di lokasi madrasah saat ini.</p></li>
        <li><span class="tahun">2013</span><p>Madrasah memperoleh akreditasi dan membuka peminatan Ilmu-ilmu Sosial.</p></li>
        <li><span class="tahun">2017</span><p>Laboratorium IPA dan perpustakaan mulai digunakan untuk kegiatan belajar rutin.</p></li>
        <li><span class="tahun">2021</span><p>Peminatan Keagamaan dibuka, disertai program tahfiz Qur&rsquo;an sebagai kegiatan harian.</p></li>
        <li><span class="tahun">2026</span><p>Madrasah mulai membangun kanal informasi digital untuk memperluas jangkauan promosi.</p></li>
      </ol>
    </div>
  </section>

  <section class="bagian bagian--sage" id="visi-misi">
    <div class="wrap duo duo--balik">
      <div class="visi muncul">
        <span class="mata mata--terang">Visi</span>
        <p class="visi__kalimat">
          Terwujudnya lulusan yang berakhlak mulia, menguasai ilmu pengetahuan,
          dan mampu mengamalkan ajaran Islam di tengah masyarakat.
        </p>
      </div>

      <div class="muncul">
        <span class="mata">Misi</span>
        <h2>Enam langkah yang kami tempuh</h2>
        <ol class="misi">
          <li>Menyelenggarakan pembelajaran yang memadukan ilmu umum dan ilmu agama secara seimbang.</li>
          <li>Membiasakan ibadah harian, tadarus, dan adab sopan santun di lingkungan madrasah.</li>
          <li>Meningkatkan kompetensi guru melalui pelatihan dan pendampingan berkelanjutan.</li>
          <li>Mengembangkan bakat siswa lewat kegiatan ekstrakurikuler yang terarah.</li>
          <li>Menyediakan sarana belajar yang layak sesuai kemampuan madrasah.</li>
          <li>Menjalin kerja sama dengan orang tua dan masyarakat dalam pembinaan siswa.</li>
        </ol>
      </div>
    </div>
  </section>

  <section class="bagian" id="struktur">
    <div class="wrap">
      <div class="kepala-bagian kepala-bagian--tengah muncul">
        <span class="mata">Struktur organisasi</span>
        <h2>Siapa mengerjakan apa</h2>
        <p class="utama">Susunan pengelola madrasah pada tahun ajaran 2025/2026.</p>
      </div>

      <div class="struktur muncul">
        <div class="struktur__baris" style="max-width:340px;margin-inline:auto">
          <div class="struktur__sel struktur__sel--puncak">
            <strong>H. Ahmad Syafi&rsquo;i, S.Pd.I., M.Pd.</strong>
            <span>Kepala Madrasah</span>
          </div>
        </div>
        <div class="struktur__baris kisi--2" style="max-width:720px;margin-inline:auto">
          <div class="struktur__sel"><strong>Yayasan Nuruddien</strong><span>Pembina</span></div>
          <div class="struktur__sel"><strong>Komite Madrasah</strong><span>Perwakilan wali murid</span></div>
        </div>
        <div class="struktur__baris kisi--4">
          <div class="struktur__sel"><strong>Nurhayati, S.Pd.</strong><span>Waka Kurikulum</span></div>
          <div class="struktur__sel"><strong>Muhammad Ridwan, S.Pd.</strong><span>Waka Kesiswaan</span></div>
          <div class="struktur__sel"><strong>Siti Aminah, S.Ag.</strong><span>Waka Sarana &amp; Prasarana</span></div>
          <div class="struktur__sel"><strong>Zulkifli, S.Kom.</strong><span>Kepala Tata Usaha</span></div>
        </div>
        <div class="struktur__baris kisi--3">
          <div class="struktur__sel"><strong>Wali kelas X, XI, XII</strong><span>12 rombongan belajar</span></div>
          <div class="struktur__sel"><strong>Guru mata pelajaran</strong><span>Rumpun umum &amp; agama</span></div>
          <div class="struktur__sel"><strong>Pembina ekstrakurikuler</strong><span>8 kegiatan</span></div>
        </div>
      </div>
      <p class="kecil abu" style="margin-top:22px;text-align:center">Nama pejabat pada bagan ini dapat diperbarui melalui halaman pengelolaan profil.</p>
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
          <blockquote>
            &ldquo;Selamat datang di MA Nuruddien. Gedung kami memang tidak besar, tapi kami
            berusaha jujur dalam menemani setiap murid bertumbuh.&rdquo;
          </blockquote>
          <p style="margin-top:18px;font-size:0.98rem;color:var(--ink-soft)">
            Kepada calon siswa dan orang tua, pintu madrasah terbuka untuk berkunjung dan bertanya.
            Kami akan senang menjelaskan langsung bagaimana pembelajaran berjalan di sini.
          </p>
          <figcaption>
            <strong>H. Ahmad Syafi&rsquo;i, S.Pd.I., M.Pd.</strong>
            Kepala Madrasah Aliyah Nuruddien
          </figcaption>
        </div>
      </figure>
    </div>
  </section>
</main>
@endsection
