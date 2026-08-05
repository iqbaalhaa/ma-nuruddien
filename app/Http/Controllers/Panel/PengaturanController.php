<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Teks tunggal yang tersebar di seluruh situs. Dikelompokkan per bagian
 * supaya admin tidak menghadapi satu borang panjang berisi 38 kolom.
 */
class PengaturanController extends Controller
{
    public const GRUP = [
        'umum' => ['Identitas situs', 'Nama madrasah dan teks yang muncul di banyak halaman.'],
        'hero' => ['Sampul beranda', 'Judul besar dan pengantar di bagian paling atas beranda.'],
        'statistik' => ['Angka statistik', 'Empat angka pada pita hijau di beranda.'],
        'profil' => ['Halaman profil', 'Sejarah, visi, identitas, dan sambutan kepala madrasah.'],
        'akademik' => ['Halaman akademik', 'Pengantar kurikulum dan daftar mata pelajaran.'],
        'kontak' => ['Kontak dan media sosial', 'Alamat, telepon, email, dan tautan media sosial.'],
    ];

    public function indeks(string $grup = 'umum'): View
    {
        abort_unless(isset(self::GRUP[$grup]), 404);

        return view('panel.pengaturan', [
            'grupAktif' => $grup,
            'kolom' => Pengaturan::where('grup', $grup)->orderBy('urutan')->get(),
        ]);
    }

    public function simpan(Request $request, string $grup): RedirectResponse
    {
        abort_unless(isset(self::GRUP[$grup]), 404);

        $kolom = Pengaturan::where('grup', $grup)->get();

        // Hanya kunci milik grup ini yang diterima, jadi kiriman yang menyusup
        // dengan nama kunci grup lain diabaikan.
        $aturan = [];
        foreach ($kolom as $k) {
            $aturan[($k->jenis === 'gambar' ? '' : 'nilai.').$k->kunci] = match ($k->jenis) {
                'angka' => 'nullable|integer|min:0|max:1000000',
                'gambar' => KontenController::ATURAN_GAMBAR,
                default => 'nullable|string|max:2000',
            };
        }

        $request->validate($aturan);
        $masuk = $request->input('nilai', []);

        foreach ($kolom as $k) {
            if ($k->jenis === 'gambar') {
                $this->simpanGambar($request, $k);

                continue;
            }

            if (array_key_exists($k->kunci, $masuk)) {
                $k->update(['nilai' => $masuk[$k->kunci]]);
            }
        }

        Pengaturan::lupakanCache();

        return redirect()
            ->route('panel.pengaturan.indeks', $grup)
            ->with('kabar', 'Pengaturan '.mb_strtolower(self::GRUP[$grup][0]).' sudah disimpan.');
    }

    /**
     * Kolom gambar dikirim sebagai berkas, bukan teks, jadi ditangani terpisah.
     * Kolom yang dibiarkan kosong berarti gambar lama tetap dipakai.
     */
    private function simpanGambar(Request $request, Pengaturan $kolom): void
    {
        $lama = $kolom->nilai;

        if ($request->boolean('hapus_'.$kolom->kunci) && $lama) {
            Storage::disk('unggahan')->delete($lama);
            $kolom->update(['nilai' => '']);

            return;
        }

        if (! $request->hasFile($kolom->kunci)) {
            return;
        }

        if ($lama) {
            Storage::disk('unggahan')->delete($lama);
        }

        $kolom->update([
            'nilai' => $request->file($kolom->kunci)->store('situs', 'unggahan'),
        ]);
    }
}
