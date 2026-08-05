<?php

namespace App\Providers;

use App\Models\Pesan;
use App\Models\Tamu;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tampilan halaman bawaan Laravel memakai Tailwind, yang tidak dipakai
        // proyek ini. Diganti dengan versi ringkas bergaya panel.
        Paginator::defaultView('pagination.panel');

        // Tanggal dan nama bulan ditulis dalam bahasa Indonesia.
        Carbon::setLocale('id');

        // Angka lencana di menu panel. Dihitung sekali per permintaan lewat
        // composer supaya tiap tampilan panel tidak perlu mengirimkannya sendiri.
        View::composer('layouts.panel', function ($view) {
            $view->with([
                'pesanBaru' => Pesan::jumlahBelumDibaca(),
                'tamuBaru' => Tamu::jumlahMenunggu(),
            ]);
        });
    }
}
