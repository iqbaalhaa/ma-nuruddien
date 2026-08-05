<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Pesan;
use App\Models\Prestasi;
use App\Models\Tamu;
use Illuminate\Contracts\View\View;

class DasborController extends Controller
{
    public function indeks(): View
    {
        return view('panel.dasbor', [
            'jumlahBerita' => Berita::count(),
            'beritaDraf' => Berita::where('terbit', false)->count(),
            'jumlahPrestasi' => Prestasi::count(),
            'jumlahFasilitas' => Fasilitas::count(),
            'jumlahGaleri' => Galeri::count(),
            'pesanBelumDibaca' => Pesan::jumlahBelumDibaca(),
            'tamuMenunggu' => Tamu::jumlahMenunggu(),
            'beritaTerakhir' => Berita::terbaru()->limit(5)->get(),
            'pesanTerakhir' => Pesan::latest()->limit(5)->get(),
        ]);
    }
}
