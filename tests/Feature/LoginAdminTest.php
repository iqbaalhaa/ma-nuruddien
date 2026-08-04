<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class LoginAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_formulir_masuk_dapat_dibuka_lewat_url(): void
    {
        $respons = $this->get('/panel/masuk');

        $respons->assertOk();
        $respons->assertSee('Masuk ke panel');
        $respons->assertSee('noindex', false);
    }

    public function test_tidak_ada_rute_registrasi(): void
    {
        $namaRute = collect(Route::getRoutes())->map->getName()->filter()->all();

        $this->assertNotContains('register', $namaRute);
        $this->assertNotContains('password.request', $namaRute);

        $this->get('/register')->assertNotFound();
        $this->post('/register')->assertNotFound();
    }

    public function test_admin_dapat_masuk_dan_diarahkan_ke_dasbor(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@manuruddien.sch.id',
        ]);

        $respons = $this->post('/panel/masuk', [
            'email' => 'admin@manuruddien.sch.id',
            'password' => 'password',
        ]);

        $respons->assertRedirect('/panel');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_kata_sandi_salah_ditolak(): void
    {
        User::factory()->admin()->create(['email' => 'admin@manuruddien.sch.id']);

        $respons = $this->from('/panel/masuk')->post('/panel/masuk', [
            'email' => 'admin@manuruddien.sch.id',
            'password' => 'salah-total',
        ]);

        $respons->assertRedirect('/panel/masuk');
        $respons->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_akun_bukan_admin_ditolak_walau_kata_sandi_benar(): void
    {
        User::factory()->create([
            'email' => 'guru@manuruddien.sch.id',
            'is_admin' => false,
        ]);

        $respons = $this->from('/panel/masuk')->post('/panel/masuk', [
            'email' => 'guru@manuruddien.sch.id',
            'password' => 'password',
        ]);

        $respons->assertRedirect('/panel/masuk');
        $respons->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_tamu_diarahkan_ke_formulir_masuk(): void
    {
        $this->get('/panel')->assertRedirect('/panel/masuk');
    }

    public function test_pengguna_bukan_admin_tidak_bisa_membuka_dasbor(): void
    {
        $guru = User::factory()->create(['is_admin' => false]);

        $this->actingAs($guru)->get('/panel')->assertForbidden();
    }

    public function test_admin_yang_sudah_masuk_dialihkan_dari_formulir(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)->get('/panel/masuk')->assertRedirect('/panel');
    }

    public function test_dasbor_tampil_untuk_admin(): void
    {
        $admin = User::factory()->admin()->create(['name' => 'Admin Madrasah']);

        $respons = $this->actingAs($admin)->get('/panel');

        $respons->assertOk();
        $respons->assertSee('Dasbor');
        $respons->assertSee('Admin Madrasah');
    }

    public function test_admin_dapat_keluar(): void
    {
        $admin = User::factory()->admin()->create();

        $respons = $this->actingAs($admin)->post('/panel/keluar');

        $respons->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_percobaan_masuk_dibatasi(): void
    {
        User::factory()->admin()->create(['email' => 'admin@manuruddien.sch.id']);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/panel/masuk', [
                'email' => 'admin@manuruddien.sch.id',
                'password' => 'salah',
            ]);
        }

        $this->post('/panel/masuk', [
            'email' => 'admin@manuruddien.sch.id',
            'password' => 'salah',
        ])->assertStatus(429);
    }
}
