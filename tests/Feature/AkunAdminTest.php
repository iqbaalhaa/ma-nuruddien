<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AkunAdminTest extends TestCase
{
    use RefreshDatabase;

    private function admin(string $sandi = 'sandiLama123'): User
    {
        return User::factory()->admin()->create([
            'email' => 'admin@sekolah.com',
            'password' => Hash::make($sandi),
        ]);
    }

    public function test_halaman_akun_hanya_untuk_admin_yang_sudah_masuk(): void
    {
        $this->get('/panel/akun')->assertRedirect('/panel/masuk');

        $guru = User::factory()->create(['is_admin' => false]);
        $this->actingAs($guru)->get('/panel/akun')->assertForbidden();

        $this->actingAs($this->admin())->get('/panel/akun')->assertOk();
    }

    public function test_admin_dapat_mengganti_kata_sandi(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->put('/panel/akun/sandi', [
            'sandi_lama' => 'sandiLama123',
            'sandi' => 'sandiBaru456',
            'sandi_confirmation' => 'sandiBaru456',
        ])->assertRedirect('/panel/akun');

        $this->assertTrue(Hash::check('sandiBaru456', $admin->fresh()->password));
    }

    /** Mengganti kata sandi lalu keluar, supaya percobaan masuk benar-benar diproses. */
    private function gantiLaluKeluar(User $admin, string $baru = 'sandiBaru456'): void
    {
        $this->actingAs($admin)->put('/panel/akun/sandi', [
            'sandi_lama' => 'sandiLama123',
            'sandi' => $baru,
            'sandi_confirmation' => $baru,
        ]);

        // Tanpa keluar dulu, middleware guest akan mengalihkan permintaan masuk
        // ke dasbor tanpa pernah memeriksa kata sandinya.
        auth()->logout();
        $this->assertGuest();
    }

    public function test_kata_sandi_baru_langsung_dapat_dipakai_masuk(): void
    {
        $admin = $this->admin();
        $this->gantiLaluKeluar($admin);

        $this->post('/panel/masuk', [
            'email' => 'admin@sekolah.com',
            'password' => 'sandiBaru456',
        ])->assertRedirect('/panel');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_kata_sandi_lama_tidak_berlaku_lagi(): void
    {
        $admin = $this->admin();
        $this->gantiLaluKeluar($admin);

        $this->post('/panel/masuk', [
            'email' => 'admin@sekolah.com',
            'password' => 'sandiLama123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_kata_sandi_sekarang_wajib_benar(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->put('/panel/akun/sandi', [
            'sandi_lama' => 'tebakan-ngawur',
            'sandi' => 'sandiBaru456',
            'sandi_confirmation' => 'sandiBaru456',
        ])->assertSessionHasErrors('sandi_lama');

        $this->assertTrue(Hash::check('sandiLama123', $admin->fresh()->password));
    }

    public function test_ulangan_kata_sandi_harus_sama(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->put('/panel/akun/sandi', [
            'sandi_lama' => 'sandiLama123',
            'sandi' => 'sandiBaru456',
            'sandi_confirmation' => 'salah-ketik',
        ])->assertSessionHasErrors('sandi');

        $this->assertTrue(Hash::check('sandiLama123', $admin->fresh()->password));
    }

    public function test_kata_sandi_terlalu_lemah_ditolak(): void
    {
        $admin = $this->admin();

        foreach (['pendek1', 'hurufsaja', '12345678'] as $lemah) {
            $this->actingAs($admin)->put('/panel/akun/sandi', [
                'sandi_lama' => 'sandiLama123',
                'sandi' => $lemah,
                'sandi_confirmation' => $lemah,
            ])->assertSessionHasErrors('sandi');
        }

        $this->assertTrue(Hash::check('sandiLama123', $admin->fresh()->password));
    }

    public function test_nama_dan_email_dapat_diperbarui(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->put('/panel/akun', [
            'name' => 'Zulkifli, S.Kom.',
            'email' => 'admin@sekolah.com',
        ])->assertRedirect('/panel/akun');

        $this->assertSame('Zulkifli, S.Kom.', $admin->fresh()->name);
    }

    public function test_email_tidak_boleh_bentrok_dengan_pengguna_lain(): void
    {
        $admin = $this->admin();
        User::factory()->create(['email' => 'lain@sekolah.com']);

        $this->actingAs($admin)->put('/panel/akun', [
            'name' => 'Admin', 'email' => 'lain@sekolah.com',
        ])->assertSessionHasErrors('email');
    }

    /**
     * Tanpa ini, menjalankan seeder ulang akan diam-diam mengembalikan kata
     * sandi ke nilai lama di .env dan admin terkunci di luar panelnya sendiri.
     */
    public function test_seeder_tidak_menimpa_kata_sandi_yang_sudah_diganti(): void
    {
        $this->seed(AdminSeeder::class);

        $admin = User::where('email', config('madrasah.admin.email'))->first();
        $admin->update(['password' => Hash::make('sandiBaru456')]);

        $this->seed(AdminSeeder::class);

        $this->assertTrue(Hash::check('sandiBaru456', $admin->fresh()->password));
        $this->assertSame(1, User::where('is_admin', true)->count());
    }
}
