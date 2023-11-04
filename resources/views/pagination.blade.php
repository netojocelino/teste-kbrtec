@props([
    'paginator',
    'theme' => 'dark',

])

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


@if ($theme == 'dark')
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
@elseif ($theme == 'public')
<nav aria-label="Paginação torneios">
    <ul class="mt-12 -space-x-px text-lg flex justify-center">

<!-- first/previous -->
@if($paginator->currentPage() > 1)
    <li>
        <a
          href="{{ $paginator->url($paginator->currentPage() - 1) }}"
          class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700"
          >Anterior</a
        >
      </li>

@endif

    <!-- links -->
    @for($i = $from; $i <= $to; $i++)
        @php
            $isCurrentPage = $paginator->currentPage() == $i;
        @endphp
      <li>
        <a
            {{ $isCurrentPage ? 'aria-current="page"' : '' }}
            href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}"
            class="flex items-center justify-center px-4 h-10 border border-gray-300
            {{
                $isCurrentPage
                ? 'text-blue-600 font-bold bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                : 'leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700'
            }}"
          >{{ $i }}</a
        >
      </li>
    @endfor

    <!-- next/last -->
    @if($paginator->currentPage() < $paginator->lastPage())
      <li>
        <a
          href="{{ $paginator->url($paginator->currentPage() + 1) }}"
          class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700"
          >Próxima</a
        >
      </li>
    @endif

    </ul>
  </nav>
@endif



@endif
