@if ($paginator->hasPages())
    <nav>
        <ul class="content_detail__pagination cdp">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="cdp_i last-elem disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">PREV</span>
                </li>
            @else
                <a  class="cdp_i last-elem"
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev" aria-label="@lang('pagination.previous')">PREV
                </a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="cdp_i active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <a class="cdp_i" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a  class="cdp_i last-elem"
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next" aria-label="@lang('pagination.next')">NEXT
                </a>
            @else
                <li class="cdp_i last-elem disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">NEXT</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
