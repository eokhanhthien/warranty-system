<div class="pagination justify-content-center" id="pagination">
    <ul class="pagination">
        @if ($products->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a href="{{ $products->previousPageUrl() }}" class="page-link" rel="prev">&laquo;</a></li>
        @endif

        @for ($i = 1; $i <= $products->lastPage(); $i++)
            @if ($i == $products->currentPage())
                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a></li>
            @endif
        @endfor

        @if ($products->hasMorePages())
            <li class="page-item"><a href="{{ $products->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
    </div>