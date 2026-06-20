@if ($paginator->hasPages())
<nav aria-label="Navigasi Halaman" class="fure-pagination-nav">
    <div class="fure-pagination-info">
        Menampilkan <strong>{{ $paginator->firstItem() }}</strong>–<strong>{{ $paginator->lastItem() }}</strong>
        dari <strong>{{ $paginator->total() }}</strong> data
    </div>

    <ul class="fure-pagination">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <li class="fure-page-item disabled">
                <span class="fure-page-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </span>
            </li>
        @else
            <li class="fure-page-item">
                <a class="fure-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman Sebelumnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </a>
            </li>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="fure-page-item disabled">
                    <span class="fure-page-link fure-page-dots">···</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="fure-page-item active" aria-current="page">
                            <span class="fure-page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="fure-page-item">
                            <a class="fure-page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <li class="fure-page-item">
                <a class="fure-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman Berikutnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            </li>
        @else
            <li class="fure-page-item disabled">
                <span class="fure-page-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
            </li>
        @endif
    </ul>
</nav>
@endif
