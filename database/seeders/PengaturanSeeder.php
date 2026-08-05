<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

/**
 * Teks tunggal yang sebelumnya ditulis langsung di berkas tampilan.
 * updateOrCreate dipakai supaya seeder aman dijalankan ulang: kolom yang
 * sudah diubah admin lewat panel tidak akan tertimpa nilai bawaan, karena
 * hanya label dan petunjuknya yang diperbarui.
 */
class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $urutan = 0;

        foreach ($this->daftar() as $kunci => $d) {
            $baru = ! Pengaturan::where('kunci', $kunci)->exists();

            Pengaturan::updateOrCreate(
                ['kunci' => $kunci],
                array_filter([
                    'grup' => $d['grup'],
                    'label' => $d['label'],
                    'jenis' => $d['jenis'] ?? 'teks',
                    'petunjuk' => $d['petunjuk'] ?? null,
                    'urutan' => ++$urutan,
                    'nilai' => $baru ? $d['nilai'] : null,
                ], fn ($v) => $v !== null)
            );
        }

        $this->command?->info('Pengaturan situs: '.Pengaturan::count().' kolom.');
    }

    private function daftar(): array
    {
        return [
            // ---------- Umum ----------
            'nama_madrasah' => [
                'grup' => 'umum', 'label' => 'Nama madrasah',
                'nilai' => 'Madrasah Aliyah Nuruddien',
            ],
            'nama_pendek' => [
                'grup' => 'umum', 'label' => 'Nama pendek',
                'petunjuk' => 'Dipakai di logo header dan footer.',
                'nilai' => 'MA Nuruddien',
            ],
            'wilayah' => [
                'grup' => 'umum', 'label' => 'Wilayah',
                'nilai' => 'Tanjung Jabung Barat',
            ],
            'logo' => [
                'grup' => 'umum', 'label' => 'Logo madrasah', 'jenis' => 'gambar',
                'petunjuk' => 'Tampil di header dan footer. Sebaiknya persegi, latar tembus pandang, minimal 200x200 piksel. Kalau dikosongkan, lambang bawaan yang dipakai.',
                'nilai' => '',
            ],
            'favicon' => [
                'grup' => 'umum', 'label' => 'Favicon', 'jenis' => 'gambar',
                'petunjuk' => 'Ikon kecil di tab peramban. Persegi, 32x32 sampai 512x512 piksel. Kalau dikosongkan, logo di atas yang dipakai.',
                'nilai' => '',
            ],
            'deskripsi_situs' => [
                'grup' => 'umum', 'label' => 'Deskripsi situs', 'jenis' => 'panjang',
                'petunjuk' => 'Muncul di hasil pencarian Google dan saat tautan dibagikan.',
                'nilai' => 'Madrasah Aliyah Nuruddien Kabupaten Tanjung Jabung Barat. Kurikulum terpadu umum dan agama, guru bersertifikasi, dan pembinaan karakter untuk generasi berakhlak, cerdas, dan berprestasi.',
            ],
            'tentang_footer' => [
                'grup' => 'umum', 'label' => 'Tentang di footer', 'jenis' => 'panjang',
                'nilai' => 'Madrasah Aliyah swasta di Kuala Tungkal, Provinsi Jambi. Membina siswa dengan ilmu umum dan ilmu agama sejak 2003.',
            ],

            // ---------- Hero beranda ----------
            'hero_mata' => [
                'grup' => 'hero', 'label' => 'Label kecil di atas judul',
                'nilai' => 'Madrasah Aliyah Swasta · Jambi',
            ],
            'hero_judul' => [
                'grup' => 'hero', 'label' => 'Judul utama', 'jenis' => 'panjang',
                'petunjuk' => 'Apit satu kata dengan tanda bintang untuk memberinya warna emas, contoh: generasi *berakhlak*.',
                'nilai' => 'Membentuk generasi *berakhlak*, cerdas, dan berprestasi.',
            ],
            'hero_teks' => [
                'grup' => 'hero', 'label' => 'Paragraf pengantar', 'jenis' => 'panjang',
                'nilai' => 'MA Nuruddien memadukan ilmu umum dan ilmu agama dalam satu ruang belajar di Kabupaten Tanjung Jabung Barat. Kami membina siswa agar siap melanjutkan ke perguruan tinggi tanpa kehilangan akar keislamannya.',
            ],
            'hero_catatan' => [
                'grup' => 'hero', 'label' => 'Catatan di bawah tombol',
                'nilai' => 'Terakreditasi B',
            ],

            'beranda_keunggulan_judul' => [
                'grup' => 'hero', 'label' => 'Judul bagian keunggulan',
                'nilai' => 'Tiga hal yang kami jaga setiap hari',
            ],
            'beranda_keunggulan_teks' => [
                'grup' => 'hero', 'label' => 'Pengantar bagian keunggulan', 'jenis' => 'panjang',
                'nilai' => 'Kebiasaan yang kami jalankan konsisten sejak kelas X sampai kelas XII.',
            ],
            'beranda_sekilas_judul' => [
                'grup' => 'hero', 'label' => 'Judul bagian sekilas madrasah',
                'nilai' => 'Madrasah kecil di tepi Tungkal yang terus berbenah',
            ],
            'beranda_sekilas_1' => [
                'grup' => 'hero', 'label' => 'Sekilas madrasah paragraf 1', 'jenis' => 'panjang',
                'nilai' => 'Madrasah Aliyah Nuruddien berdiri untuk menjawab kebutuhan warga sekitar akan sekolah menengah atas yang tetap menomorsatukan pendidikan agama. Sejak angkatan pertama, madrasah tumbuh pelan tapi tidak pernah berhenti: menambah ruang kelas, membuka laboratorium, dan memperluas kegiatan siswa.',
            ],
            'beranda_sekilas_2' => [
                'grup' => 'hero', 'label' => 'Sekilas madrasah paragraf 2', 'jenis' => 'panjang',
                'nilai' => 'Hari ini MA Nuruddien menampung ratusan siswa dari beberapa kecamatan di Tanjung Jabung Barat. Sebagian melanjutkan ke perguruan tinggi keagamaan, sebagian ke jalur umum, dan sebagian lagi kembali membangun kampung halamannya.',
            ],

            // ---------- Statistik ----------
            'statistik_siswa' => [
                'grup' => 'statistik', 'label' => 'Siswa aktif', 'jenis' => 'angka', 'nilai' => '324',
            ],
            'statistik_guru' => [
                'grup' => 'statistik', 'label' => 'Guru dan staf', 'jenis' => 'angka', 'nilai' => '28',
            ],
            'statistik_ekskul' => [
                'grup' => 'statistik', 'label' => 'Ekstrakurikuler', 'jenis' => 'angka', 'nilai' => '8',
            ],
            'statistik_tahun' => [
                'grup' => 'statistik', 'label' => 'Tahun mengabdi', 'jenis' => 'angka', 'nilai' => '23',
            ],

            // ---------- Profil ----------
            'profil_sejarah_judul' => [
                'grup' => 'profil', 'label' => 'Judul bagian sejarah',
                'nilai' => 'Berawal dari satu ruang kelas pinjaman',
            ],
            'profil_sejarah_1' => [
                'grup' => 'profil', 'label' => 'Sejarah paragraf 1', 'jenis' => 'panjang',
                'nilai' => 'MA Nuruddien lahir dari keresahan sederhana warga Kuala Tungkal: lulusan madrasah tsanawiyah setempat harus menempuh perjalanan jauh untuk melanjutkan sekolah menengah atas berbasis keagamaan. Beberapa tokoh masyarakat lalu bersepakat mendirikan madrasah aliyah sendiri.',
            ],
            'profil_sejarah_2' => [
                'grup' => 'profil', 'label' => 'Sejarah paragraf 2', 'jenis' => 'panjang',
                'nilai' => 'Tahun pertama hanya ada satu rombongan belajar dengan meja seadanya. Dari sana, madrasah tumbuh perlahan mengikuti kemampuan yayasan dan dukungan wali murid, sampai memiliki gedung, laboratorium, dan perpustakaannya sendiri.',
            ],
            'visi' => [
                'grup' => 'profil', 'label' => 'Visi', 'jenis' => 'panjang',
                'nilai' => 'Terwujudnya lulusan yang berakhlak mulia, menguasai ilmu pengetahuan, dan mampu mengamalkan ajaran Islam di tengah masyarakat.',
            ],
            'kepala_nama' => [
                'grup' => 'profil', 'label' => 'Nama kepala madrasah',
                'nilai' => 'H. Ahmad Syafi’i, S.Pd.I., M.Pd.',
            ],
            'kepala_sambutan' => [
                'grup' => 'profil', 'label' => 'Kutipan sambutan kepala', 'jenis' => 'panjang',
                'nilai' => 'Selamat datang di MA Nuruddien. Gedung kami memang tidak besar, tapi kami berusaha jujur dalam menemani setiap murid bertumbuh.',
            ],
            'kepala_sambutan_lanjut' => [
                'grup' => 'profil', 'label' => 'Sambutan paragraf lanjutan', 'jenis' => 'panjang',
                'nilai' => 'Kepada calon siswa dan orang tua, pintu madrasah terbuka untuk berkunjung dan bertanya. Kami akan senang menjelaskan langsung bagaimana pembelajaran berjalan di sini.',
            ],
            'kepala_kutipan_beranda' => [
                'grup' => 'profil', 'label' => 'Kutipan kepala di beranda', 'jenis' => 'panjang',
                'nilai' => 'Tugas kami menemani anak-anak sampai mereka paham kenapa mereka perlu belajar. Prestasi biasanya menyusul setelah itu.',
            ],
            'identitas_jenjang' => ['grup' => 'profil', 'label' => 'Jenjang', 'nilai' => 'Menengah atas (setara SMA)'],
            'identitas_status' => ['grup' => 'profil', 'label' => 'Status', 'nilai' => 'Swasta, di bawah naungan Kementerian Agama'],
            'identitas_akreditasi' => ['grup' => 'profil', 'label' => 'Akreditasi', 'nilai' => 'B'],

            // ---------- Akademik ----------
            'kurikulum_judul' => [
                'grup' => 'akademik', 'label' => 'Judul bagian kurikulum',
                'nilai' => 'Dua rumpun ilmu, satu jadwal belajar',
            ],
            'kurikulum_teks' => [
                'grup' => 'akademik', 'label' => 'Pengantar kurikulum', 'jenis' => 'panjang',
                'nilai' => 'MA Nuruddien menjalankan kurikulum nasional yang berlaku di madrasah aliyah, ditambah rumpun mata pelajaran keagamaan sesuai ketentuan Kementerian Agama.',
            ],
            'mapel_umum' => [
                'grup' => 'akademik', 'label' => 'Mata pelajaran umum', 'jenis' => 'panjang',
                'nilai' => 'Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, Kimia, Biologi, Ekonomi, Sosiologi, Geografi, Sejarah, PPKn, PJOK, Informatika, dan Seni Budaya.',
            ],
            'mapel_agama' => [
                'grup' => 'akademik', 'label' => 'Mata pelajaran keagamaan', 'jenis' => 'panjang',
                'nilai' => 'Al-Qur’an Hadis, Akidah Akhlak, Fikih, Sejarah Kebudayaan Islam, dan Bahasa Arab, ditambah program tahfiz harian.',
            ],
            'tahun_ajaran' => ['grup' => 'akademik', 'label' => 'Tahun ajaran berjalan', 'nilai' => '2025/2026'],

            // ---------- Kontak ----------
            'alamat' => [
                'grup' => 'kontak', 'label' => 'Alamat', 'jenis' => 'panjang',
                'nilai' => "Jl. Pendidikan No. 12, Kuala Tungkal\nKabupaten Tanjung Jabung Barat\nProvinsi Jambi 36513",
            ],
            'telepon' => ['grup' => 'kontak', 'label' => 'Telepon', 'nilai' => '(0742) 000 000'],
            'whatsapp' => ['grup' => 'kontak', 'label' => 'WhatsApp', 'nilai' => '0812-0000-0000'],
            'email' => ['grup' => 'kontak', 'label' => 'Email', 'nilai' => 'info@manuruddien.sch.id'],
            'jam_layanan' => [
                'grup' => 'kontak', 'label' => 'Jam layanan',
                'nilai' => 'Senin sampai Sabtu, pukul 07.30 sampai 14.00 WIB',
            ],
            'peta' => [
                'grup' => 'kontak', 'label' => 'Alamat peta', 'jenis' => 'panjang',
                'petunjuk' => 'Tulis alamat atau koordinat. Dipakai untuk peta di halaman kontak.',
                'nilai' => 'Kuala Tungkal, Tanjung Jabung Barat, Jambi',
            ],
            'facebook' => ['grup' => 'kontak', 'label' => 'Tautan Facebook', 'nilai' => ''],
            'instagram' => ['grup' => 'kontak', 'label' => 'Tautan Instagram', 'nilai' => ''],
            'youtube' => ['grup' => 'kontak', 'label' => 'Tautan YouTube', 'nilai' => ''],
        ];
    }
}
