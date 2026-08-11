<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Akun admin yang sedang masuk.
 *
 * Sebelum ada halaman ini, mengganti kata sandi harus lewat menyunting .env
 * lalu menjalankan seeder, yang tidak mungkin dikerjakan pengelola madrasah
 * sendiri.
 */
class AkunController extends Controller
{
    public function indeks(): View
    {
        return view('panel.akun', [
            'pengguna' => auth()->user(),
        ]);
    }

    /** Nama dan email. Tidak perlu kata sandi lama karena tidak mengubah akses. */
    public function perbarui(Request $request): RedirectResponse
    {
        $pengguna = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', 'max:150', Rule::unique('users')->ignore($pengguna->id)],
        ], [], [
            'name' => 'nama', 'email' => 'email',
        ]);

        $pengguna->update($data);

        $kabar = 'Nama dan email sudah diperbarui.';

        // Seeder mencocokkan akun berdasarkan email. Kalau emailnya sekarang
        // beda dengan yang di .env, menjalankan seeder akan membuat akun admin
        // kedua, bukan memperbarui yang ini.
        if ($pengguna->email !== config('madrasah.admin.email')) {
            $kabar .= ' Sesuaikan juga ADMIN_EMAIL di berkas .env supaya seeder tidak membuat akun admin kedua.';
        }

        return redirect()->route('panel.akun.indeks')->with('kabar', $kabar);
    }

    public function gantiSandi(Request $request): RedirectResponse
    {
        $request->validate([
            'sandi_lama' => ['required', 'current_password'],
            'sandi' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'sandi_lama.current_password' => 'Kata sandi sekarang tidak cocok.',
            'sandi.confirmed' => 'Ulangan kata sandi baru tidak sama.',
        ], [
            'sandi_lama' => 'kata sandi sekarang',
            'sandi' => 'kata sandi baru',
        ]);

        $request->user()->update([
            'password' => Hash::make($request->string('sandi')->toString()),
        ]);

        // Sesi diperbarui supaya penanda sesi lama tidak bisa dipakai ulang.
        $request->session()->regenerate();

        return redirect()->route('panel.akun.indeks')
            ->with('kabar', 'Kata sandi sudah diganti. Pakai yang baru saat masuk berikutnya.');
    }
}
