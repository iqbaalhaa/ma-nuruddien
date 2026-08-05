<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\JadwalHarian;
use App\Models\Linimasa;
use App\Models\Misi;
use App\Models\Peminatan;
use App\Models\Pengurus;
use App\Models\Pesan;
use App\Models\Prestasi;
use App\Models\Tamu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HalamanPublikController extends Controller
{
    public function beranda(): View
    {
        return view('publik.beranda', [
            'keunggulan' => \App\Models\Keunggulan::urut()->get(),
            'berita' => Berita::tayang()->terbaru()->limit(3)->get(),
            'fasilitas' => Fasilitas::urut()->limit(4)->get(),
        ]);
    }

    public function profil(): View
    {
        return view('publik.profil', [
            'linimasa' => Linimasa::urut()->get(),
            'misi' => Misi::urut()->get(),
            'pengurus' => Pengurus::urut()->get()->groupBy('baris'),
        ]);
    }

    public function akademik(): View
    {
        return view('publik.akademik', [
            'jadwal' => JadwalHarian::urut()->get(),
            'peminatan' => Peminatan::urut()->get(),
            'agenda' => Agenda::urut()->get(),
            'prestasi' => Prestasi::urut()->get(),
        ]);
    }

    public function fasilitas(): View
    {
        return view('publik.fasilitas', [
            'fasilitas' => Fasilitas::urut()->get(),
            'ekskul' => Ekstrakurikuler::urut()->get(),
            'galeri' => Galeri::urut()->get(),
        ]);
    }

    public function berita(): View
    {
        return view('publik.berita', [
            'berita' => Berita::tayang()->terbaru()->get(),
        ]);
    }

    public function beritaSatu(Berita $berita): View
    {
        // Draf dan berita bertanggal masa depan tidak boleh terbaca publik
        // walaupun alamatnya ditebak.
        abort_unless($berita->terbit && $berita->tanggal->isPast(), 404);

        return view('publik.berita-satu', [
            'berita' => $berita,
            'lainnya' => Berita::tayang()->terbaru()
                ->where('id', '!=', $berita->id)->limit(3)->get(),
        ]);
    }

    public function kontak(): View
    {
        return view('publik.kontak', [
            'tamu' => Tamu::disetujui()->latest()->limit(6)->get(),
        ]);
    }

    // ------------------------------------------------------------ kiriman

    public function kirimPesan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'peran' => 'nullable|string|max:60',
            'pesan' => 'required|string|max:2000',
            'jebakan' => 'prohibited',      // diisi robot, ditolak
        ], [
            'jebakan.prohibited' => 'Pengiriman ditolak.',
        ], [
            'nama' => 'nama', 'email' => 'email', 'pesan' => 'pesan',
        ]);

        unset($data['jebakan']);
        Pesan::create($data + ['ip' => $request->ip()]);

        return back()
            ->with('kabarKontak', 'Terima kasih, pesan Anda sudah kami terima. Kami membalas pada jam kerja madrasah.')
            ->withFragment('kirim-pesan');
    }

    public function kirimTamu(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'peran' => 'nullable|string|max:60',
            'pesan' => 'required|string|max:600',
            'jebakan' => 'prohibited',
        ], [
            'jebakan.prohibited' => 'Pengiriman ditolak.',
        ], [
            'nama' => 'nama', 'pesan' => 'pesan',
        ]);

        unset($data['jebakan']);
        Tamu::create($data + ['ip' => $request->ip(), 'tampil' => false]);

        return back()
            ->with('kabarTamu', 'Terima kasih. Pesan Anda akan tampil setelah diperiksa pengelola madrasah.')
            ->withFragment('buku-tamu');
    }
}
