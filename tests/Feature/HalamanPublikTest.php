<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Pesan;
use App\Models\Tamu;
use Database\Seeders\KontenSeeder;
use Database\Seeders\PengaturanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class HalamanPublikTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Isi halaman sekarang datang dari basis data, jadi tanpa seeder
        // halaman publik hanya berisi kerangka kosong.
        $this->seed([PengaturanSeeder::class, KontenSeeder::class]);
    }

    public function test_beranda_tampil_di_akar_situs(): void
    {
        $respons = $this->get('/');

        $respons->assertOk();
        $respons->assertSee('Membentuk generasi', false);
        $respons->assertSee('MA Nuruddien');
    }

    #[DataProvider('halamanPublik')]
    public function test_semua_halaman_publik_dapat_dibuka(string $jalur): void
    {
        $this->get($jalur)->assertOk();
    }

    public static function halamanPublik(): array
    {
        return [
            'beranda' => ['/'],
            'profil' => ['/profil'],
            'akademik' => ['/akademik'],
            'fasilitas' => ['/fasilitas'],
            'berita' => ['/berita'],
            'kontak' => ['/kontak'],
        ];
    }

    public function test_halaman_publik_tidak_menautkan_panel_admin(): void
    {
        foreach (array_column(static::halamanPublik(), 0) as $jalur) {
            $this->get($jalur)->assertDontSee('panel/masuk');
        }
    }

    public function test_isi_halaman_ikut_berubah_saat_pengaturan_diubah(): void
    {
        \App\Models\Pengaturan::where('kunci', 'statistik_siswa')->update(['nilai' => '999']);
        \App\Models\Pengaturan::lupakanCache();

        $this->get('/')->assertSee('data-hitung="999"', false);
    }

    public function test_berita_dapat_dibaca_satu_per_satu(): void
    {
        $berita = Berita::tayang()->first();

        $this->get(route('berita.baca', $berita))
            ->assertOk()
            ->assertSee($berita->judul);
    }

    public function test_berita_draf_tidak_bisa_dibuka_publik(): void
    {
        $berita = Berita::first();
        $berita->update(['terbit' => false]);

        $this->get(route('berita.baca', $berita))->assertNotFound();
        $this->get('/berita')->assertDontSee($berita->judul);
    }

    public function test_berita_bertanggal_masa_depan_belum_tampil(): void
    {
        $berita = Berita::first();
        $berita->update(['tanggal' => now()->addWeek()]);

        $this->get(route('berita.baca', $berita))->assertNotFound();
    }

    public function test_formulir_kontak_menyimpan_pesan(): void
    {
        $this->post(route('kontak.pesan'), [
            'nama' => 'Ibu Rohani',
            'email' => 'rohani@contoh.id',
            'peran' => 'Orang tua atau wali',
            'pesan' => 'Kapan pendaftaran dibuka?',
        ])->assertRedirect();

        $this->assertDatabaseHas('pesan', [
            'email' => 'rohani@contoh.id',
            'dibaca' => false,
        ]);
    }

    public function test_kiriman_robot_ditolak_lewat_kolom_jebakan(): void
    {
        $this->post(route('kontak.pesan'), [
            'nama' => 'Robot', 'email' => 'robot@spam.id',
            'pesan' => 'Iklan.', 'jebakan' => 'terisi',
        ])->assertSessionHasErrors('jebakan');

        $this->assertSame(0, Pesan::count());
    }

    public function test_buku_tamu_baru_tampil_setelah_disetujui(): void
    {
        $this->post(route('kontak.tamu'), [
            'nama' => 'Fajar', 'peran' => 'Alumni', 'pesan' => 'Semoga terus berkembang.',
        ])->assertRedirect();

        $this->get('/kontak')->assertDontSee('Semoga terus berkembang.');

        Tamu::first()->update(['tampil' => true]);

        $this->get('/kontak')->assertSee('Semoga terus berkembang.');
    }

    public function test_berkas_html_statis_tidak_lagi_dapat_diakses(): void
    {
        $this->assertFileDoesNotExist(public_path('ma-nuruddien/index.html'));
    }
}
