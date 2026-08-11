<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Menyiapkan satu akun admin madrasah dari nilai di .env.
     *
     * Kata sandi hanya ditulis saat akunnya pertama kali dibuat. Kalau akunnya
     * sudah ada, kata sandinya tidak disentuh, karena admin bisa menggantinya
     * sendiri lewat menu Akun saya di panel. Tanpa aturan ini, menjalankan
     * seeder ulang akan diam-diam mengembalikan kata sandi ke nilai .env yang
     * sudah usang.
     */
    public function run(): void
    {
        $email = config('madrasah.admin.email');
        $admin = User::where('email', $email)->first();

        if ($admin) {
            $admin->update([
                'name' => config('madrasah.admin.nama'),
                'is_admin' => true,
            ]);

            $this->command?->info('Akun admin sudah ada, kata sandinya dibiarkan: '.$email);
        } else {
            User::create([
                'email' => $email,
                'name' => config('madrasah.admin.nama'),
                'password' => config('madrasah.admin.password'),
                'is_admin' => true,
            ]);

            $this->command?->info('Akun admin dibuat: '.$email);
        }

        // Kalau ADMIN_EMAIL pernah diganti, akun admin yang lama tetap ada di
        // basis data dan masih bisa dipakai masuk. Itu diberitahukan di sini
        // supaya tidak lolos tanpa disadari.
        $lain = User::where('is_admin', true)
            ->where('email', '!=', $email)
            ->pluck('email');

        if ($lain->isNotEmpty()) {
            $this->command?->warn('Masih ada akun admin lain yang aktif: '.$lain->implode(', '));
            $this->command?->warn('Hapus lewat tinker bila sudah tidak dipakai.');
        }
    }
}
