@if ($paginator->hasPages())
    <nav class="blog-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn btn-outline-secondary disabled" aria-disabled="true">@lang('pagination.next')</a>
        @else
            <a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.next')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-outline-primary ml-1" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.previous')</a>
        @else
            <a class="btn btn-outline-secondary disabled ml-1" aria-disabled="true">@lang('pagination.previous')</a>
        @endif
    </nav>
@endif
