@if (isset($paginator) && $paginator->lastPage() > 1)

@php
    $interval = isset($interval) ? abs(intval($interval)) : 3 ;
    $from = $paginator->currentPage() - $interval;
    if($from < 1){
        $from = 1;
    }

    $to = $paginator->currentPage() + $interval;
    if($to > $paginator->lastPage()){
        $to = $paginator->lastPage();
    }
@endphp

<nav aria-label="navigation">
    <ul class="pagination justify-content-end pt-4 pb-2">


    <!-- first/previous -->
    @if($paginator->currentPage() > 1)
        <li class="page-item">
            <a class="page-link bg-custom border-dark link-light" href="{{ $paginator->url(1) }}">
                Início
            </a>
        </li>

        <li class="page-item">
            <a class="page-link bg-custom border-dark link-light" href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous">
                Anterior
            </a>
        </li>

    @endif


    <!-- links -->
    @for($i = $from; $i <= $to; $i++)
        @php
            $isCurrentPage = $paginator->currentPage() == $i;
        @endphp
        <li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
            <a class="page-link bg-custom border-dark link-light" href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">
                {{ $i }}
            </a>
        </li>
    @endfor


    <!-- next/last -->
    @if($paginator->currentPage() < $paginator->lastPage())
        <li class="page-item">
            <a class="page-link bg-custom border-dark link-light" href="{{ $paginator->url($paginator->currentPage() + 1) }}">
                Próxima
            </a>
        </li>

        <li class="page-item">
            <a class="page-link bg-custom border-dark link-light" href="{{ $paginator->url($paginator->lastpage()) }}">
                Última
            </a>
        </li>
    @endif

    </ul>
</nav>
@endif
