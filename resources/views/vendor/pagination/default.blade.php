@if ($paginator->hasPages())
    {{--<ul class="pagination">--}}
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
                <i class="fa fa-chevron-left link"></i>
        @else
            <a class="link"  href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <i class="fa fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"><span class="current">{{ $page }}</span></a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="fa fa-chevron-right"></i>
            </a>
        @else
            <i class="fa fa-chevron-right link"></i>
        @endif
    {{--</ul>--}}
@endif
