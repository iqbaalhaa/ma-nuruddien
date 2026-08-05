@props(['nama' => 'kelas', 'tebal' => '1.6'])

@php
    $ikon = config('ikon.'.$nama) ?? config('ikon.kelas');
@endphp

<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $tebal }}"
     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" {{ $attributes }}>
  {!! $ikon['jalur'] !!}
</svg>
