@if ($paginator->hasPages())
<nav class="paginate-container" role="navigation">
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <span class="previous_page disabled">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="previous_page" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
            <span class="gap">...</span>
            @endif

            @if (is_array($element))
                @foreach($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <em class="current selected" aria-current="true">{{ $page }}</em>
                    @else
                        <a href="{{ $url }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="next_page" rel="next" aria-label="@lang('pagination.next')">Next</a>
        @else
            <span class="next_page disabled">Next</span>
        @endif
    </div>
</nav>
@endif
