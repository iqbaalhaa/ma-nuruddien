<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Induk pengelolaan konten berbentuk daftar.
 *
 * Sepuluh jenis konten di situs ini punya kebutuhan yang sama persis: lihat
 * daftar, tambah, ubah, hapus, dan atur urutan. Alih-alih menyalin kode itu
 * sepuluh kali, tiap jenis cukup mengumumkan skema kolomnya lewat medan(),
 * lalu seluruh alur dan tampilannya ditangani di sini.
 *
 * Menambah jenis konten baru cukup dengan membuat satu turunan pendek dan
 * mendaftarkannya di routes/web.php.
 */
abstract class KontenController extends Controller
{
    /** Pilihan warna kartu, mengikuti palet yang dipakai halaman publik. */
    public const WARNA = [
        'pucuk' => 'Hijau pucuk',
        'emas' => 'Emas',
        'tanah' => 'Tanah liat',
        'polos' => 'Polos',
    ];

    /** Batas unggahan gambar. SVG sengaja ditolak karena bisa memuat skrip. */
    public const ATURAN_GAMBAR = 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072';

    /** @var class-string<\App\Models\KontenDasar> */
    protected string $model;

    protected string $rute;      // contoh: prestasi
    protected string $judul;     // judul halaman, contoh: Prestasi siswa
    protected string $satuan;    // sebutan satu baris, contoh: prestasi
    protected ?string $catatan = null;   // penjelasan di bawah judul
    protected string $folderGambar = 'konten';

    /**
     * Skema kolom. Tiap entri:
     *   nama     nama kolom di basis data
     *   label    judul kolom di panel
     *   jenis    teks | panjang | angka | pilih | ikon | warna | gambar
     *   aturan   aturan validasi Laravel
     *   pilihan  array nilai untuk jenis pilih
     *   petunjuk keterangan kecil di bawah kolom
     *   daftar   true bila ikut ditampilkan di tabel daftar
     */
    abstract protected function medan(): array;

    // ---------------------------------------------------------------- tampil

    public function indeks()
    {
        return view('panel.konten.indeks', $this->bekal([
            'baris' => $this->model::urut()->get(),
        ]));
    }

    public function buat()
    {
        return view('panel.konten.borang', $this->bekal([
            'data' => new $this->model,
            'aksi' => route("panel.$this->rute.simpan"),
            'baru' => true,
        ]));
    }

    public function ubah(int $id)
    {
        return view('panel.konten.borang', $this->bekal([
            'data' => $this->model::findOrFail($id),
            'aksi' => route("panel.$this->rute.perbarui", $id),
            'baru' => false,
        ]));
    }

    // ---------------------------------------------------------------- ubah

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->periksa($request);
        $data['urutan'] = $this->model::urutanBerikutnya();

        $this->model::create($data);

        return redirect()
            ->route("panel.$this->rute.indeks")
            ->with('kabar', ucfirst($this->satuan).' baru berhasil disimpan.');
    }

    public function perbarui(Request $request, int $id): RedirectResponse
    {
        $data = $this->model::findOrFail($id);
        $data->update($this->periksa($request, $data));

        return redirect()
            ->route("panel.$this->rute.indeks")
            ->with('kabar', 'Perubahan pada '.$this->satuan.' sudah disimpan.');
    }

    public function hapus(int $id): RedirectResponse
    {
        $data = $this->model::findOrFail($id);

        // Berkas gambarnya ikut dibuang supaya tidak menumpuk jadi sampah.
        foreach ($this->medan() as $m) {
            if (($m['jenis'] ?? '') === 'gambar' && $data->{$m['nama']}) {
                Storage::disk('unggahan')->delete($data->{$m['nama']});
            }
        }

        $data->delete();

        return redirect()
            ->route("panel.$this->rute.indeks")
            ->with('kabar', ucfirst($this->satuan).' sudah dihapus.');
    }

    /** Menaikkan atau menurunkan satu baris dengan menukar nomor urutnya. */
    public function geser(Request $request, int $id): RedirectResponse
    {
        $arah = $request->input('arah') === 'naik' ? 'naik' : 'turun';
        $ini = $this->model::findOrFail($id);

        $tetangga = $this->model::query()
            ->when($arah === 'naik',
                fn ($q) => $q->where('urutan', '<', $ini->urutan)->orderByDesc('urutan'),
                fn ($q) => $q->where('urutan', '>', $ini->urutan)->orderBy('urutan'))
            ->first();

        if ($tetangga) {
            [$ini->urutan, $tetangga->urutan] = [$tetangga->urutan, $ini->urutan];
            $ini->save();
            $tetangga->save();
        }

        return back();
    }

    // ---------------------------------------------------------------- bantu

    /** Data bersama untuk semua tampilan jenis konten ini. */
    protected function bekal(array $tambahan = []): array
    {
        return array_merge([
            'judul' => $this->judul,
            'satuan' => $this->satuan,
            'catatan' => $this->catatan,
            'rute' => $this->rute,
            'medan' => $this->medan(),
        ], $tambahan);
    }

    protected function periksa(Request $request, $data = null): array
    {
        $aturan = [];
        $label = [];

        foreach ($this->medan() as $m) {
            $aturan[$m['nama']] = $m['aturan'] ?? 'nullable|string';
            $label[$m['nama']] = mb_strtolower($m['label']);
        }

        $bersih = $request->validate($aturan, [], $label);

        // Gambar ditangani terpisah: kolom kosong berarti "biarkan yang lama".
        foreach ($this->medan() as $m) {
            if (($m['jenis'] ?? '') !== 'gambar') {
                continue;
            }

            $kolom = $m['nama'];

            if ($request->boolean('hapus_'.$kolom) && $data?->{$kolom}) {
                Storage::disk('unggahan')->delete($data->{$kolom});
                $bersih[$kolom] = null;

                continue;
            }

            if ($request->hasFile($kolom)) {
                if ($data?->{$kolom}) {
                    Storage::disk('unggahan')->delete($data->{$kolom});
                }
                $bersih[$kolom] = $request->file($kolom)->store($this->folderGambar, 'unggahan');

                continue;
            }

            unset($bersih[$kolom]);   // tidak diubah
        }

        return $bersih;
    }
}
