@if ($paginator->hasPages())
    <nav class="d-flex justify-content-end">
        <ul class="pagination ">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled mr-1">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item mr-1">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif
            @if ($paginator->hasMorePages())
                <li class="page-item mr-1">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled mr-1">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

