@if ($paginator->hasPages())
  <nav aria-label="Navigasi halaman">
    @if ($paginator->onFirstPage())
      <span class="tbl-mini" aria-disabled="true" style="opacity:.5">Sebelumnya</span>
    @else
      <a class="tbl-mini" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
    @endif

    @foreach ($elements as $element)
      @if (is_string($element))
        <span class="tbl-mini" aria-hidden="true" style="border:0">{{ $element }}</span>
      @endif

      @if (is_array($element))
        @foreach ($element as $halaman => $url)
          @if ($halaman == $paginator->currentPage())
            <span class="tbl-mini" aria-current="page"
                  style="background:var(--pucuk);border-color:var(--pucuk);color:#fff">{{ $halaman }}</span>
          @else
            <a class="tbl-mini" href="{{ $url }}">{{ $halaman }}</a>
          @endif
        @endforeach
      @endif
    @endforeach

    @if ($paginator->hasMorePages())
      <a class="tbl-mini" href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya</a>
    @else
      <span class="tbl-mini" aria-disabled="true" style="opacity:.5">Berikutnya</span>
    @endif
  </nav>
@endif
