<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class HalamanPublikTest extends TestCase
{
    use RefreshDatabase;

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
            $respons = $this->get($jalur);

            $respons->assertDontSee('panel/masuk');
            $respons->assertDontSee('Masuk', false);
        }
    }

    public function test_berkas_html_statis_tidak_lagi_dapat_diakses(): void
    {
        $this->assertFileDoesNotExist(public_path('ma-nuruddien/index.html'));
    }
}
