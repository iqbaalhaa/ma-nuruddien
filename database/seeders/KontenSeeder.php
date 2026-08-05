<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\JadwalHarian;
use App\Models\Linimasa;
use App\Models\Misi;
use App\Models\Peminatan;
use App\Models\Pengurus;
use App\Models\Prestasi;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi yang sebelumnya ditulis langsung di berkas tampilan.
 * Hanya mengisi tabel yang masih kosong, jadi menjalankannya ulang tidak akan
 * menggandakan data atau menimpa hasil kerja admin di panel.
 */
class KontenSeeder extends Seeder
{
    public function run(): void
    {
        $this->isi(\App\Models\Keunggulan::class, [
            ['judul' => 'Kurikulum terpadu', 'ikon' => 'buku',
                'keterangan' => 'Mata pelajaran umum berjalan beriringan dengan tafsir, hadis, fikih, dan bahasa Arab. Siswa tidak perlu memilih salah satu.'],
            ['judul' => 'Prestasi yang terukur', 'ikon' => 'piala',
                'keterangan' => 'Siswa kami rutin mewakili madrasah di MTQ, olimpiade sains madrasah, dan lomba kepramukaan tingkat kabupaten.'],
            ['judul' => 'Guru bersertifikasi', 'ikon' => 'guru',
                'keterangan' => 'Mayoritas guru berlatar S1 kependidikan dan telah lulus sertifikasi, dengan pembinaan wali kelas untuk setiap rombongan belajar.'],
        ]);

        $this->isi(Linimasa::class, [
            ['tahun' => '2003', 'peristiwa' => 'Madrasah didirikan oleh Yayasan Nuruddien dengan satu rombongan belajar dan enam tenaga pengajar.'],
            ['tahun' => '2008', 'peristiwa' => 'Gedung permanen tiga ruang kelas selesai dibangun di lokasi madrasah saat ini.'],
            ['tahun' => '2013', 'peristiwa' => 'Madrasah memperoleh akreditasi dan membuka peminatan Ilmu-ilmu Sosial.'],
            ['tahun' => '2017', 'peristiwa' => 'Laboratorium IPA dan perpustakaan mulai digunakan untuk kegiatan belajar rutin.'],
            ['tahun' => '2021', 'peristiwa' => 'Peminatan Keagamaan dibuka, disertai program tahfiz Qur’an sebagai kegiatan harian.'],
            ['tahun' => '2026', 'peristiwa' => 'Madrasah mulai membangun kanal informasi digital untuk memperluas jangkauan promosi.'],
        ]);

        $this->isi(Misi::class, [
            ['isi' => 'Menyelenggarakan pembelajaran yang memadukan ilmu umum dan ilmu agama secara seimbang.'],
            ['isi' => 'Membiasakan ibadah harian, tadarus, dan adab sopan santun di lingkungan madrasah.'],
            ['isi' => 'Meningkatkan kompetensi guru melalui pelatihan dan pendampingan berkelanjutan.'],
            ['isi' => 'Mengembangkan bakat siswa lewat kegiatan ekstrakurikuler yang terarah.'],
            ['isi' => 'Menyediakan sarana belajar yang layak sesuai kemampuan madrasah.'],
            ['isi' => 'Menjalin kerja sama dengan orang tua dan masyarakat dalam pembinaan siswa.'],
        ]);

        $this->isi(Pengurus::class, [
            ['nama' => 'H. Ahmad Syafi’i, S.Pd.I., M.Pd.', 'jabatan' => 'Kepala Madrasah', 'baris' => 1],
            ['nama' => 'Yayasan Nuruddien', 'jabatan' => 'Pembina', 'baris' => 2],
            ['nama' => 'Komite Madrasah', 'jabatan' => 'Perwakilan wali murid', 'baris' => 2],
            ['nama' => 'Nurhayati, S.Pd.', 'jabatan' => 'Waka Kurikulum', 'baris' => 3],
            ['nama' => 'Muhammad Ridwan, S.Pd.', 'jabatan' => 'Waka Kesiswaan', 'baris' => 3],
            ['nama' => 'Siti Aminah, S.Ag.', 'jabatan' => 'Waka Sarana & Prasarana', 'baris' => 3],
            ['nama' => 'Zulkifli, S.Kom.', 'jabatan' => 'Kepala Tata Usaha', 'baris' => 3],
            ['nama' => 'Wali kelas X, XI, XII', 'jabatan' => '12 rombongan belajar', 'baris' => 4],
            ['nama' => 'Guru mata pelajaran', 'jabatan' => 'Rumpun umum & agama', 'baris' => 4],
            ['nama' => 'Pembina ekstrakurikuler', 'jabatan' => '8 kegiatan', 'baris' => 4],
        ]);

        $this->isi(JadwalHarian::class, [
            ['waktu' => '06.50', 'kegiatan' => 'Tadarus & salat duha'],
            ['waktu' => '07.30', 'kegiatan' => 'Jam pelajaran ke-1'],
            ['waktu' => '09.50', 'kegiatan' => 'Istirahat pertama'],
            ['waktu' => '12.10', 'kegiatan' => 'Salat zuhur berjamaah'],
            ['waktu' => '12.40', 'kegiatan' => 'Jam pelajaran akhir'],
            ['waktu' => '14.20', 'kegiatan' => 'Ekstrakurikuler (terjadwal)'],
        ]);

        $this->isi(Peminatan::class, [
            [
                'kode' => 'MIA', 'nama' => 'Matematika & Ilmu Alam', 'ikon' => 'praktikum',
                'keterangan' => 'Untuk siswa yang ingin melanjutkan ke bidang sains, kesehatan, teknik, atau pendidikan MIPA.',
                'pendalaman' => 'Pendalaman pada Matematika, Fisika, Kimia, dan Biologi.',
            ],
            [
                'kode' => 'IIS', 'nama' => 'Ilmu-ilmu Sosial', 'ikon' => 'orang',
                'keterangan' => 'Untuk siswa yang tertarik pada ekonomi, hukum, komunikasi, atau pemerintahan.',
                'pendalaman' => 'Pendalaman pada Ekonomi, Sosiologi, Geografi, dan Sejarah.',
            ],
            [
                'kode' => 'Keagamaan', 'nama' => 'Ilmu-ilmu Keagamaan', 'ikon' => 'buku',
                'keterangan' => 'Untuk siswa yang ingin mendalami studi Islam dan melanjutkan ke perguruan tinggi keagamaan.',
                'pendalaman' => 'Pendalaman pada Tafsir, Hadis, Fikih, Ushul Fikih, dan Bahasa Arab.',
            ],
        ]);

        $this->isi(Agenda::class, [
            ['periode' => 'Juli 2025', 'kegiatan' => 'Awal tahun ajaran & masa taaruf siswa', 'keterangan' => 'Pengenalan lingkungan madrasah'],
            ['periode' => 'September 2025', 'kegiatan' => 'Penilaian tengah semester ganjil', 'keterangan' => 'Seluruh tingkat'],
            ['periode' => 'Desember 2025', 'kegiatan' => 'Penilaian akhir semester ganjil', 'keterangan' => 'Dilanjutkan pembagian rapor'],
            ['periode' => 'Maret 2026', 'kegiatan' => 'Pesantren kilat Ramadan', 'keterangan' => 'Kelas X dan XI'],
            ['periode' => 'April 2026', 'kegiatan' => 'Ujian madrasah kelas XII', 'keterangan' => 'Tertulis dan praktik'],
            ['periode' => 'Mei 2026', 'kegiatan' => 'Penilaian akhir semester genap', 'keterangan' => 'Kelas X dan XI'],
            ['periode' => 'Juni 2026', 'kegiatan' => 'Wisuda & pelepasan kelas XII', 'keterangan' => 'Bersama wali murid'],
        ]);

        $this->isi(Prestasi::class, [
            ['peringkat' => 'Juara 1', 'judul' => 'Lomba Kaligrafi Islam', 'keterangan' => 'Pekan Seni Madrasah tingkat kabupaten', 'tahun' => '2025'],
            ['peringkat' => 'Juara 2', 'judul' => 'MTQ cabang hifzil Qur’an 5 juz', 'keterangan' => 'Tingkat Kabupaten Tanjung Jabung Barat', 'tahun' => '2026'],
            ['peringkat' => 'Juara 2', 'judul' => 'Kompetisi Sains Madrasah bidang Biologi', 'keterangan' => 'Seleksi tingkat kabupaten', 'tahun' => '2025'],
            ['peringkat' => 'Juara 3', 'judul' => 'Lomba Tingkat Regu Pramuka Penegak', 'keterangan' => 'Kwartir Cabang Tanjung Jabung Barat', 'tahun' => '2024'],
            ['peringkat' => 'Juara 3', 'judul' => 'Turnamen Futsal Antar Madrasah', 'keterangan' => 'Piala Kemenag kabupaten', 'tahun' => '2024'],
            ['peringkat' => 'Juara 1', 'judul' => 'Lomba Pidato Bahasa Arab', 'keterangan' => 'Pekan Seni Madrasah tingkat kabupaten', 'tahun' => '2024'],
        ]);

        $this->isi(Fasilitas::class, [
            ['nama' => 'Ruang kelas', 'ringkas' => '12 rombongan belajar', 'ikon' => 'kelas', 'warna' => 'pucuk', 'keterangan' => 'Dua belas ruang kelas untuk tingkat X sampai XII, masing-masing berkapasitas sekitar 28 siswa dan dilengkapi papan tulis serta lemari arsip kelas.'],
            ['nama' => 'Laboratorium IPA', 'ringkas' => 'Fisika, kimia, biologi', 'ikon' => 'laboratorium', 'warna' => 'emas', 'keterangan' => 'Digunakan bergantian untuk praktikum fisika, kimia, dan biologi. Dilengkapi meja praktik, alat ukur dasar, mikroskop, dan lemari bahan.'],
            ['nama' => 'Laboratorium komputer', 'ringkas' => 'Informatika & asesmen', 'ikon' => 'komputer', 'warna' => 'polos', 'keterangan' => 'Berisi unit komputer untuk mata pelajaran Informatika, latihan asesmen berbasis komputer, dan kegiatan English Club.'],
            ['nama' => 'Perpustakaan', 'ringkas' => 'Koleksi umum & keagamaan', 'ikon' => 'perpustakaan', 'warna' => 'tanah', 'keterangan' => 'Menyimpan buku pelajaran, kitab rujukan, dan koleksi bacaan umum. Terbuka pada jam istirahat dan sepulang sekolah.'],
            ['nama' => 'Musala', 'ringkas' => 'Ibadah & kajian', 'ikon' => 'musala', 'warna' => 'pucuk', 'keterangan' => 'Tempat salat duha dan zuhur berjamaah, kajian pekanan, serta latihan tahfiz dan hadrah.'],
            ['nama' => 'Lapangan serbaguna', 'ringkas' => 'Upacara & olahraga', 'ikon' => 'lapangan', 'warna' => 'emas', 'keterangan' => 'Dipakai untuk upacara, PJOK, futsal, bola voli, dan latihan pramuka. Menjadi pusat kegiatan siswa di luar kelas.'],
            ['nama' => 'Ruang guru & TU', 'ringkas' => 'Administrasi & konsultasi', 'ikon' => 'gedung', 'warna' => 'polos', 'keterangan' => 'Pusat administrasi madrasah sekaligus tempat konsultasi siswa dengan wali kelas dan guru bimbingan.'],
            ['nama' => 'Ruang UKS', 'ringkas' => 'Kesehatan siswa', 'ikon' => 'kesehatan', 'warna' => 'tanah', 'keterangan' => 'Ruang pertolongan pertama yang dikelola bersama pembina dan anggota Palang Merah Remaja madrasah.'],
        ]);

        $this->isi(Ekstrakurikuler::class, [
            ['nama' => 'Pramuka'], ['nama' => 'Tahfiz Qur’an'], ['nama' => 'Hadrah & Marawis'],
            ['nama' => 'Palang Merah Remaja'], ['nama' => 'Futsal'], ['nama' => 'Bola voli'],
            ['nama' => 'Kaligrafi'], ['nama' => 'English Club'],
        ]);

        $this->isi(Galeri::class, [
            ['judul' => 'Upacara bendera', 'ringkas' => 'Setiap Senin', 'ikon' => 'bendera', 'warna' => 'pucuk', 'keterangan' => 'Dilaksanakan setiap Senin pagi di lapangan madrasah, dipimpin bergantian oleh petugas dari tiap kelas.'],
            ['judul' => 'Hari besar Islam', 'ringkas' => 'Peringatan bersama', 'ikon' => 'bulan-sabit', 'warna' => 'emas', 'keterangan' => 'Maulid Nabi, Isra Mikraj, dan Tahun Baru Hijriah diperingati bersama seluruh siswa dan wali murid.'],
            ['judul' => 'Praktikum', 'ringkas' => 'Laboratorium IPA', 'ikon' => 'praktikum', 'warna' => 'polos', 'keterangan' => 'Siswa peminatan MIA melakukan praktik pengamatan dan pengukuran didampingi guru mata pelajaran.'],
            ['judul' => 'Wisuda kelas XII', 'ringkas' => 'Akhir tahun ajaran', 'ikon' => 'wisuda', 'warna' => 'tanah', 'keterangan' => 'Pelepasan siswa kelas XII bersama wali murid di akhir tahun ajaran.'],
        ]);

        $this->isiBerita();

        $this->command?->info('Konten halaman selesai diisi.');
    }

    /** @param class-string<\Illuminate\Database\Eloquent\Model> $model */
    private function isi(string $model, array $baris): void
    {
        if ($model::query()->exists()) {
            $this->command?->line('  dilewati, sudah ada isi: '.class_basename($model));

            return;
        }

        foreach ($baris as $i => $data) {
            $model::create($data + ['urutan' => $i + 1]);
        }
    }

    private function isiBerita(): void
    {
        if (Berita::query()->exists()) {
            $this->command?->line('  dilewati, sudah ada isi: Berita');

            return;
        }

        $daftar = [
            ['2026-05-15', 'kegiatan', 'Pesantren kilat Ramadan diikuti seluruh siswa kelas X dan XI', 'Selama sepuluh hari siswa mengikuti kajian pagi, tadarus bersama, dan praktik ibadah yang dibimbing guru rumpun agama.', 'musala', 'pucuk'],
            ['2026-04-28', 'prestasi', 'Tim tahfiz meraih juara dua MTQ tingkat kabupaten', 'Dua siswa kelas XI mewakili madrasah pada cabang tilawah dan hifzil Qur’an lima juz yang digelar di Kuala Tungkal.', 'piala', 'emas'],
            ['2026-04-10', 'pengumuman', 'Jadwal ujian akhir semester genap tahun ajaran 2025/2026', 'Ujian berlangsung dua pekan. Kartu ujian dibagikan wali kelas paling lambat tiga hari sebelum pelaksanaan.', 'kalender', 'tanah'],
            ['2026-03-22', 'kegiatan', 'Siswa peminatan MIA menggelar pameran hasil praktikum sederhana', 'Enam kelompok menampilkan percobaan biologi dan fisika di lapangan madrasah, disaksikan adik kelas dan guru.', 'praktikum', 'pucuk'],
            ['2026-03-05', 'prestasi', 'Tim futsal madrasah melaju ke babak semifinal piala Kemenag', 'Setelah menang dua laga penyisihan, tim putra MA Nuruddien memastikan tempat di empat besar turnamen antar madrasah.', 'lapangan', 'emas'],
            ['2026-02-18', 'pengumuman', 'Pemberitahuan libur awal Ramadan dan jadwal masuk kembali', 'Kegiatan belajar diliburkan pada tiga hari pertama Ramadan dan dilanjutkan dengan jadwal khusus bulan puasa.', 'kalender', 'tanah'],
            ['2026-02-02', 'kegiatan', 'Kunjungan belajar ke pusat kerajinan dan pelabuhan Kuala Tungkal', 'Siswa peminatan IIS mempelajari kegiatan ekonomi masyarakat pesisir secara langsung sebagai bahan tugas Geografi.', 'orang', 'pucuk'],
            ['2026-01-20', 'kegiatan', 'Pelatihan penguatan kompetensi guru rumpun agama', 'Delapan guru mengikuti pelatihan penyusunan modul ajar yang diselenggarakan Kantor Kementerian Agama kabupaten.', 'guru', 'polos'],
            ['2026-01-08', 'prestasi', 'Siswa kelas XII meraih juara satu lomba kaligrafi pekan seni madrasah', 'Karya bertema kaligrafi kufi ini menjadi capaian pertama madrasah pada cabang seni Islam tahun ini.', 'piala', 'emas'],
        ];

        foreach ($daftar as [$tanggal, $kategori, $judul, $ringkasan, $ikon, $warna]) {
            Berita::create([
                'judul' => $judul,
                'slug' => Berita::slugUnik($judul),
                'kategori' => $kategori,
                'ringkasan' => $ringkasan,
                'isi' => $ringkasan."\n\nIsi lengkap berita ini belum ditulis. Buka panel admin, pilih menu Berita, lalu lengkapi naskahnya.",
                'ikon' => $ikon,
                'warna' => $warna,
                'tanggal' => $tanggal,
                'terbit' => true,
            ]);
        }
    }
}
