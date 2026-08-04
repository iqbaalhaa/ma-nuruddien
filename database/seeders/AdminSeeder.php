<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Membuat (atau memperbarui) satu akun admin madrasah.
     * Nilainya diambil dari .env supaya kata sandi tidak ikut tersimpan di kode.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('madrasah.admin.email')],
            [
                'name' => config('madrasah.admin.nama'),
                'password' => config('madrasah.admin.password'),
                'is_admin' => true,
            ]
        );

        $this->command?->info('Akun admin siap: '.config('madrasah.admin.email'));

        // Kalau ADMIN_EMAIL pernah diganti, akun admin yang lama tetap ada di
        // basis data dan masih bisa dipakai masuk. Itu diberitahukan di sini
        // supaya tidak lolos tanpa disadari.
        $lain = User::where('is_admin', true)
            ->where('email', '!=', config('madrasah.admin.email'))
            ->pluck('email');

        if ($lain->isNotEmpty()) {
            $this->command?->warn('Masih ada akun admin lain yang aktif: '.$lain->implode(', '));
            $this->command?->warn('Hapus lewat tinker bila sudah tidak dipakai.');
        }
    }
}
