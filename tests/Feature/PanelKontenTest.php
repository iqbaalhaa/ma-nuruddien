<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Pengaturan;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PanelKontenTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
    }

    // ------------------------------------------------------------ akses

    #[DataProvider('halamanPanel')]
    public function test_halaman_panel_dapat_dibuka_admin(string $jalur): void
    {
        $this->actingAs($this->admin)->get($jalur)->assertOk();
    }

    #[DataProvider('halamanPanel')]
    public function test_halaman_panel_tertutup_untuk_tamu(string $jalur): void
    {
        $this->get($jalur)->assertRedirect('/panel/masuk');
    }

    public static function halamanPanel(): array
    {
        return [
            ['/panel'], ['/panel/berita'], ['/panel/berita/baru'],
            ['/panel/prestasi'], ['/panel/fasilitas'], ['/panel/galeri'],
            ['/panel/ekstrakurikuler'], ['/panel/peminatan'], ['/panel/agenda'],
            ['/panel/jadwal-harian'], ['/panel/linimasa'], ['/panel/misi'],
            ['/panel/pengurus'], ['/panel/pengaturan'], ['/panel/pesan'],
            ['/panel/buku-tamu'],
        ];
    }

    // ------------------------------------------------------------ konten daftar

    public function test_admin_dapat_menambah_dan_menghapus_prestasi(): void
    {
        $this->actingAs($this->admin)
            ->post('/panel/prestasi', [
                'peringkat' => 'Juara 1', 'judul' => 'Lomba Tahfiz',
                'keterangan' => 'Tingkat provinsi', 'tahun' => '2026',
            ])
            ->assertRedirect('/panel/prestasi');

        $this->assertDatabaseHas('prestasi', ['judul' => 'Lomba Tahfiz', 'urutan' => 1]);

        $id = Prestasi::first()->id;

        $this->actingAs($this->admin)->delete("/panel/prestasi/$id")->assertRedirect();
        $this->assertSame(0, Prestasi::count());
    }

    public function test_kolom_wajib_diperiksa(): void
    {
        $this->actingAs($this->admin)
            ->post('/panel/prestasi', ['peringkat' => '', 'judul' => '', 'tahun' => ''])
            ->assertSessionHasErrors(['peringkat', 'judul', 'tahun']);

        $this->assertSame(0, Prestasi::count());
    }

    public function test_urutan_dapat_digeser(): void
    {
        $satu = Prestasi::create(['peringkat' => 'Juara 1', 'judul' => 'A', 'tahun' => '2025', 'urutan' => 1]);
        $dua = Prestasi::create(['peringkat' => 'Juara 2', 'judul' => 'B', 'tahun' => '2025', 'urutan' => 2]);

        $this->actingAs($this->admin)->post("/panel/prestasi/{$dua->id}/geser", ['arah' => 'naik']);

        $this->assertSame(2, $satu->fresh()->urutan);
        $this->assertSame(1, $dua->fresh()->urutan);
    }

    // ------------------------------------------------------------ berita

    public function test_berita_baru_mendapat_slug_otomatis(): void
    {
        $this->actingAs($this->admin)->post('/panel/berita', [
            'judul' => 'Pesantren Kilat Ramadan 2026',
            'kategori' => 'kegiatan',
            'tanggal' => '2026-03-01',
            'ringkasan' => 'Ringkasan singkat kegiatan.',
            'isi' => 'Naskah lengkap berita.',
            'ikon' => 'musala', 'warna' => 'pucuk', 'terbit' => '1',
        ])->assertRedirect('/panel/berita');

        $this->assertDatabaseHas('berita', [
            'slug' => 'pesantren-kilat-ramadan-2026',
            'terbit' => true,
        ]);
    }

    public function test_slug_tidak_bentrok_saat_judulnya_sama(): void
    {
        foreach ([1, 2] as $i) {
            $this->actingAs($this->admin)->post('/panel/berita', [
                'judul' => 'Rapat Wali Murid', 'kategori' => 'pengumuman',
                'tanggal' => '2026-0'.$i.'-01', 'ringkasan' => 'Ringkasan.',
                'isi' => 'Isi.', 'ikon' => 'kalender', 'warna' => 'tanah',
            ]);
        }

        $this->assertSame(
            ['rapat-wali-murid', 'rapat-wali-murid-2'],
            Berita::orderBy('id')->pluck('slug')->all()
        );
    }

    public function test_tombol_terbit_mengubah_status_berita(): void
    {
        $berita = Berita::create([
            'judul' => 'Draf', 'slug' => 'draf', 'kategori' => 'kegiatan',
            'ringkasan' => 'R', 'isi' => 'I', 'tanggal' => now(), 'terbit' => false,
        ]);

        // Rute panel berita terikat lewat slug, bukan id.
        $this->actingAs($this->admin)->post(route('panel.berita.terbit', $berita));

        $this->assertTrue($berita->fresh()->terbit);
    }

    public function test_gambar_berita_tersimpan_di_folder_unggahan_bukan_symlink(): void
    {
        Storage::fake('unggahan');

        $this->actingAs($this->admin)->post('/panel/berita', [
            'judul' => 'Dengan Foto', 'kategori' => 'kegiatan', 'tanggal' => '2026-01-01',
            'ringkasan' => 'R', 'isi' => 'I', 'ikon' => 'wisuda', 'warna' => 'pucuk',
            'gambar' => UploadedFile::fake()->image('kegiatan.jpg', 800, 600),
        ]);

        $berita = Berita::first();

        $this->assertNotNull($berita->gambar);
        $this->assertStringStartsWith('berita/', $berita->gambar);
        Storage::disk('unggahan')->assertExists($berita->gambar);
    }

    public function test_berkas_berbahaya_ditolak(): void
    {
        Storage::fake('unggahan');

        $this->actingAs($this->admin)->post('/panel/berita', [
            'judul' => 'Jahat', 'kategori' => 'kegiatan', 'tanggal' => '2026-01-01',
            'ringkasan' => 'R', 'isi' => 'I', 'ikon' => 'wisuda', 'warna' => 'pucuk',
            'gambar' => UploadedFile::fake()->create('jahat.php', 10, 'application/x-php'),
        ])->assertSessionHasErrors('gambar');

        $this->assertSame(0, Berita::count());
    }

    // ------------------------------------------------------------ pengaturan

    public function test_pengaturan_tersimpan_dan_cache_disegarkan(): void
    {
        $this->seed(\Database\Seeders\PengaturanSeeder::class);

        $this->actingAs($this->admin)->put('/panel/pengaturan/statistik', [
            'nilai' => ['statistik_siswa' => '400'],
        ])->assertRedirect();

        $this->assertSame('400', Pengaturan::ambil('statistik_siswa'));
    }

    public function test_pengaturan_grup_lain_tidak_ikut_tertimpa(): void
    {
        $this->seed(\Database\Seeders\PengaturanSeeder::class);
        $sebelum = Pengaturan::ambil('nama_madrasah');

        // Kunci milik grup umum diselundupkan lewat borang grup statistik.
        $this->actingAs($this->admin)->put('/panel/pengaturan/statistik', [
            'nilai' => ['statistik_siswa' => '400', 'nama_madrasah' => 'Diretas'],
        ]);

        $this->assertSame($sebelum, Pengaturan::ambil('nama_madrasah'));
    }

    public function test_logo_dan_favicon_dapat_diunggah_lalu_dihapus(): void
    {
        Storage::fake('unggahan');
        $this->seed(\Database\Seeders\PengaturanSeeder::class);

        $this->actingAs($this->admin)->put('/panel/pengaturan/umum', [
            'logo' => UploadedFile::fake()->image('logo.png', 300, 300),
            'favicon' => UploadedFile::fake()->image('favicon.png', 64, 64),
        ])->assertRedirect();

        $logo = Pengaturan::ambil('logo');
        $this->assertStringStartsWith('situs/', $logo);
        Storage::disk('unggahan')->assertExists($logo);

        // Halaman publik memakai logo unggahan, bukan lambang bawaan.
        $this->get('/')
            ->assertSee('unggahan/'.$logo, false)
            ->assertDontSee('<svg class="merek__lambang"', false);

        // Setelah dihapus, kembali ke lambang bawaan.
        $this->actingAs($this->admin)->put('/panel/pengaturan/umum', [
            'hapus_logo' => '1', 'hapus_favicon' => '1',
        ]);

        Storage::disk('unggahan')->assertMissing($logo);
        $this->get('/')->assertSee('<svg class="merek__lambang"', false);
    }

    public function test_logo_menolak_berkas_yang_bukan_gambar(): void
    {
        Storage::fake('unggahan');
        $this->seed(\Database\Seeders\PengaturanSeeder::class);

        $this->actingAs($this->admin)->put('/panel/pengaturan/umum', [
            'logo' => UploadedFile::fake()->create('jahat.php', 10, 'application/x-php'),
        ])->assertSessionHasErrors('logo');

        $this->assertSame('', Pengaturan::ambil('logo', ''));
    }

    public function test_grup_pengaturan_yang_tidak_dikenal_ditolak(): void
    {
        $this->actingAs($this->admin)->get('/panel/pengaturan/ngawur')->assertNotFound();
    }

    // ------------------------------------------------------------ hak akses

    public function test_pengguna_bukan_admin_ditolak_di_semua_halaman_panel(): void
    {
        $guru = User::factory()->create(['is_admin' => false]);

        $this->actingAs($guru)->get('/panel/berita')->assertForbidden();
        $this->actingAs($guru)->post('/panel/prestasi', [])->assertForbidden();
    }
}
