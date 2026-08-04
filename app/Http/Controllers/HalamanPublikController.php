<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HalamanPublikController extends Controller
{
    public function beranda(): View
    {
        return view('publik.beranda');
    }

    public function profil(): View
    {
        return view('publik.profil');
    }

    public function akademik(): View
    {
        return view('publik.akademik');
    }

    public function fasilitas(): View
    {
        return view('publik.fasilitas');
    }

    public function berita(): View
    {
        return view('publik.berita');
    }

    public function kontak(): View
    {
        return view('publik.kontak');
    }
}
