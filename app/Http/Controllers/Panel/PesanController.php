<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\Tamu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Kotak masuk formulir kontak dan moderasi buku tamu.
 * Keduanya hanya bisa dibaca, disetujui, atau dihapus. Admin tidak menyunting
 * kiriman orang lain supaya isinya tetap apa adanya.
 */
class PesanController extends Controller
{
    public function indeks(Request $request): View
    {
        return view('panel.pesan', [
            'pesan' => Pesan::query()
                ->when($request->string('saring')->toString() === 'belum', fn ($q) => $q->where('dibaca', false))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'saring' => $request->string('saring')->toString(),
            'belumDibaca' => Pesan::jumlahBelumDibaca(),
        ]);
    }

    public function baca(Pesan $pesan): RedirectResponse
    {
        $pesan->update(['dibaca' => ! $pesan->dibaca]);

        return back();
    }

    public function hapus(Pesan $pesan): RedirectResponse
    {
        $pesan->delete();

        return back()->with('kabar', 'Pesan sudah dihapus.');
    }

    // ---------------------------------------------------------- buku tamu

    public function tamu(): View
    {
        return view('panel.tamu', [
            'tamu' => Tamu::latest()->paginate(20),
            'menunggu' => Tamu::jumlahMenunggu(),
        ]);
    }

    public function tamuAlih(Tamu $tamu): RedirectResponse
    {
        $tamu->update(['tampil' => ! $tamu->tampil]);

        return back()->with('kabar', $tamu->tampil
            ? 'Pesan tamu sekarang tampil di halaman kontak.'
            : 'Pesan tamu disembunyikan dari halaman kontak.');
    }

    public function tamuHapus(Tamu $tamu): RedirectResponse
    {
        $tamu->delete();

        return back()->with('kabar', 'Pesan tamu sudah dihapus.');
    }
}
