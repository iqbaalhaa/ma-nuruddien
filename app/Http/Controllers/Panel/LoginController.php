<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Formulir masuk. Halaman ini sengaja tidak ditautkan dari mana pun dan
     * ditandai noindex, jadi hanya bisa dibuka dengan mengetik URL-nya.
     */
    public function tampilkan(): View
    {
        return view('panel.masuk');
    }

    public function masuk(Request $request): RedirectResponse
    {
        $kredensial = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [], [
            'email' => 'email',
            'password' => 'kata sandi',
        ]);

        $ingat = $request->boolean('ingat');

        if (! Auth::attempt($kredensial, $ingat)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi tidak cocok.',
            ]);
        }

        // Tanpa registrasi: hanya akun yang ditandai admin yang boleh masuk.
        if (! Auth::user()->is_admin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak punya akses ke panel admin.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('panel.dasbor'));
    }

    public function keluar(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}
