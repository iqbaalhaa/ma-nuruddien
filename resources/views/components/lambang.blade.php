@props(['warna' => '#1e5a4c', 'kelas' => 'merek__lambang'])

{{-- Logo unggahan dipakai bila ada. Kalau belum diunggah, lambang bawaan
     yang digambar sebagai SVG tetap tampil, jadi header tidak pernah kosong. --}}
@if (pengaturan('logo'))
  <img class="{{ $kelas }}" src="{{ asset('unggahan/'.pengaturan('logo')) }}"
       alt="Logo {{ pengaturan('nama_madrasah', 'MA Nuruddien') }}" width="40" height="40">
@else
  <svg class="{{ $kelas }}" viewBox="0 0 48 48" aria-hidden="true">
    <path d="M24 3 C34 12 39 20 39 28 v14 a3 3 0 0 1 -3 3 H12 a3 3 0 0 1 -3 -3 V28 C9 20 14 12 24 3 Z" fill="{{ $warna }}"/>
    <path d="M24 16 l2.6 7.4 7.4 -0.6 -4.8 5.7 3.6 6.8 -8.8 -3.6 -8.8 3.6 3.6 -6.8 -4.8 -5.7 7.4 0.6 Z" fill="#c79a31"/>
  </svg>
@endif
