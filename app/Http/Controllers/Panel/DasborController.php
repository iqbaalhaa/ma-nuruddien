<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DasborController extends Controller
{
    public function indeks(): View
    {
        return view('panel.dasbor');
    }
}
