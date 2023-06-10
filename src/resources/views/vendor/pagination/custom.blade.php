@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <span aria-hidden="true">&lt;</span>
    </li>
    @else
    <li>
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lt;</a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($paginator->currentPage() <= 6) {{-- Display first 10 pages --}} @if ($page <=10) @if ($page==$paginator->currentPage())
    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @elseif ($page == $paginator->lastPage() - 1)
    {{-- Display "..." separator --}}
    <li class="disabled" aria-disabled="true"><span>&hellip;</span></li>
    @elseif ($page == $paginator->lastPage())
    {{-- Display last page and the page before it --}}
    <li><a href="{{ $url }}">{{ $paginator->lastPage() - 1 }}</a></li>
    <li><a href="{{ $url }}">{{ $paginator->lastPage() }}</a></li>
    @endif
    @elseif ($paginator->currentPage() >= $paginator->lastPage() - 5)
    {{-- Display last 10 pages --}}
    @if ($page == 1)
    {{-- Display first page and the page after it --}}
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    <li><a href="{{ $url }}">{{ $page + 1 }}</a></li>
    @elseif ($page == 2)
    {{-- Display "..." separator --}}
    <li class="disabled" aria-disabled="true"><span>&hellip;</span></li>
    @elseif ($page > $paginator->lastPage() - 10)
    @if ($page == $paginator->currentPage())
    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endif
    @else
    {{-- Display middle pages --}}
    @if ($page == 1)
    {{-- Display first page --}}
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @elseif ($page == $paginator->currentPage() - 1)
    {{-- Display "..." separator --}}
    <li class="disabled" aria-disabled="true"><span>&hellip;</span></li>
    @elseif ($page >= $paginator->currentPage() - 4 && $page <= $paginator->currentPage() + 4)
    @if ($page == $paginator->currentPage())
    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @elseif ($page == $paginator->currentPage() + 1)
    {{-- Display "..." separator --}}
    <li class="disabled" aria-disabled="true"><span>&hellip;</span></li>
    @elseif ($page == $paginator->lastPage())
    {{-- Display last page --}}
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li>
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&gt;</a>
    </li>
    @else
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <span aria-hidden="true">&gt;</span>
    </li>
    @endif
</ul>
@endif