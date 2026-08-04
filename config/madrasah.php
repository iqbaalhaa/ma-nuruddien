<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Akun admin
    |--------------------------------------------------------------------------
    |
    | Situs ini tidak menyediakan registrasi. Satu-satunya akun dibuat lewat
    | `php artisan db:seed --class=AdminSeeder` memakai nilai di bawah ini,
    | yang sebaiknya diisi dari berkas .env.
    |
    */

    'admin' => [
        'nama' => env('ADMIN_NAMA', 'Admin Madrasah'),
        'email' => env('ADMIN_EMAIL', 'admin@sekolah.com'),
        'password' => env('ADMIN_PASSWORD', 'password123'),
    ],

];
