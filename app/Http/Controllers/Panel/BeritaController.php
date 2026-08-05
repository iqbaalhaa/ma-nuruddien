<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Berita dan pengumuman. Dipisah dari KontenController karena punya
 * kebutuhan sendiri: slug, penyaringan, halaman berhalaman, status terbit,
 * dan naskah panjang.
 */
class BeritaController extends Controller
{
    public function indeks(Request $request): View
    {
        $berita = Berita::query()
            ->when($request->filled('cari'), function ($q) use ($request) {
                $kata = '%'.$request->string('cari').'%';
                $q->where(fn ($s) => $s->where('judul', 'like', $kata)->orWhere('ringkasan', 'like', $kata));
            })
            ->when($request->filled('kategori'), fn ($q) => $q->where('kategori', $request->string('kategori')))
            ->when($request->filled('status'), fn ($q) => $q->where('terbit', $request->string('status') === 'terbit'))
            ->terbaru()
            ->paginate(15)
            ->withQueryString();

        return view('panel.berita.indeks', compact('berita'));
    }

    public function buat(): View
    {
        return view('panel.berita.borang', [
            'berita' => new Berita(['tanggal' => now(), 'terbit' => true, 'kategori' => 'kegiatan']),
            'aksi' => route('panel.berita.simpan'),
            'baru' => true,
        ]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->periksa($request);
        $data['slug'] = Berita::slugUnik($data['judul']);

        Berita::create($data);

        return redirect()->route('panel.berita.indeks')->with('kabar', 'Berita berhasil disimpan.');
    }

    public function ubah(Berita $berita): View
    {
        return view('panel.berita.borang', [
            'berita' => $berita,
            'aksi' => route('panel.berita.perbarui', $berita),
            'baru' => false,
        ]);
    }

    public function perbarui(Request $request, Berita $berita): RedirectResponse
    {
        $data = $this->periksa($request, $berita);

        // Slug ikut berubah bila judulnya diubah, supaya alamatnya tetap masuk akal.
        if ($data['judul'] !== $berita->judul) {
            $data['slug'] = Berita::slugUnik($data['judul'], $berita->id);
        }

        $berita->update($data);

        return redirect()->route('panel.berita.indeks')->with('kabar', 'Perubahan berita sudah disimpan.');
    }

    public function hapus(Berita $berita): RedirectResponse
    {
        if ($berita->gambar) {
            Storage::disk('unggahan')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('panel.berita.indeks')->with('kabar', 'Berita sudah dihapus.');
    }

    /** Tombol cepat terbit atau tarik dari daftar. */
    public function alihTerbit(Berita $berita): RedirectResponse
    {
        $berita->update(['terbit' => ! $berita->terbit]);

        return back()->with('kabar', $berita->terbit
            ? 'Berita sudah tayang di situs.'
            : 'Berita ditarik dari situs dan kembali jadi draf.');
    }

    private function periksa(Request $request, ?Berita $berita = null): array
    {
        $data = $request->validate([
            'judul' => 'required|string|max:180',
            'kategori' => 'required|in:'.implode(',', array_keys(Berita::KATEGORI)),
            'tanggal' => 'required|date',
            'ringkasan' => 'required|string|max:400',
            'isi' => 'required|string',
            'ikon' => 'required|string',
            'warna' => 'required|string',
            'gambar' => KontenController::ATURAN_GAMBAR,
        ], [], [
            'judul' => 'judul', 'kategori' => 'kategori', 'tanggal' => 'tanggal',
            'ringkasan' => 'ringkasan', 'isi' => 'isi berita',
        ]);

        $data['terbit'] = $request->boolean('terbit');

        if ($request->boolean('hapus_gambar') && $berita?->gambar) {
            Storage::disk('unggahan')->delete($berita->gambar);
            $data['gambar'] = null;
        } elseif ($request->hasFile('gambar')) {
            if ($berita?->gambar) {
                Storage::disk('unggahan')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'unggahan');
        } else {
            unset($data['gambar']);
        }

        return $data;
    }
}
