<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\PastikanAdmin::class,
        ]);

        // Tamu yang mencoba membuka panel dikembalikan ke formulir masuk.
        $middleware->redirectGuestsTo(fn () => route('login'));

        // Admin yang sudah masuk tidak perlu melihat formulir masuk lagi.
        $middleware->redirectUsersTo(fn () => route('panel.dasbor'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
