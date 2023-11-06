@extends('admin.layouts.athletes.public')

@section('content')

<main
class="max-w-7xl mx-2 lg:mx-auto text-gray-900"
x-data="{active:'sobre_evento'}"
>
<img
  src="{{ $championship->cover }}"
  alt="{{ $championship->title }}"
  class="rounded-md h-[500px] w-full object-cover"
/>
<time datetime="2023-11-21" class="block mt-4 text-gray-500"
  >{{ __($championship->date->format('D')) }}, {{$championship->date->format('d')}} de {{__($championship->date->format('M'))}}</time
>
<h1
  class="my-1 font-bold text-5xl text-blue-800 flex flex-col lg:flex-row lg:items-center gap-2"
>
{{$championship->title}}
  <span class="text-gray-500 font-normal text-3xl">{{$championship->code}}</span>
</h1>
<div class="flex gap-2">
  <p class="text-gray-500 flex gap-2 my-2">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"
      />
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"
      />
    </svg>
    {{$championship->city_state}}
  </p>
  <p class="text-gray-500 flex gap-2 my-2">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
      />
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M6 6h.008v.008H6V6z"
      />
    </svg>
    {{$championship->type}}
  </p>
</div>
<ul
  class="flex flex-wrap font-medium text-center text-gray-500 border-b border-gray-200"
>
  <li>
    <h2
      class="inline-block p-4 rounded-t-lg cursor-pointer"
      id="sobre_evento"
      x-on:click="active='sobre_evento'"
      x-bind:class="active=='sobre_evento' ? 'bg-gray-100 rounded-t-lg' : 'hover:text-gray-600 hover:bg-gray-50'"
    >
      <span class="text-blue-700" x-show="active=='sobre_evento'">#</span>
      Sobre o evento
    </h2>
  </li>
  <li>
    <h2
      class="inline-block p-4 rounded-t-lg cursor-pointer"
      id="ginasio"
      x-on:click="active='ginasio'"
      x-bind:class="active=='ginasio' ? 'bg-gray-100 rounded-t-lg' : 'hover:text-gray-600 hover:bg-gray-50'"
    >
      <span class="text-blue-700" x-show="active=='ginasio'">#</span>
      Ginásio
    </h2>
  </li>
  <li>
    <h2
      class="inline-block p-4 rounded-t-lg cursor-pointer"
      id="infos_gerais"
      x-on:click="active='infos_gerais'"
      x-bind:class="active=='infos_gerais' ? 'bg-gray-100 rounded-t-lg' : 'hover:text-gray-600 hover:bg-gray-50'"
    >
      <span class="text-blue-700" x-show="active=='infos_gerais'">#</span>
      Informações gerais
    </h2>
  </li>
  @if (!empty($championship->public_entrance))
  <li>
    <h2
      class="inline-block p-4 rounded-t-lg cursor-pointer"
      id="entrada_publico"
      x-on:click="active='entrada_publico'"
      x-bind:class="active=='entrada_publico' ? 'bg-gray-100 rounded-t-lg' : 'hover:text-gray-600 hover:bg-gray-50'"
    >
      <span class="text-blue-700" x-show="active=='entrada_publico'"
        >#</span
      >
      Entrada ao público
    </h2>
  </li>
  @endif
</ul>
<article
  class="mt-4 pb-4 border-b border-blue-700/20"
  aria-labelledby="sobre_evento"
  x-show="active=='sobre_evento'"
>
  <div class="mt-4 text-lg">
    {!! $championship->about !!}
  </div>
</article>
<article
  class="mt-4 pb-4 border-b border-blue-700/20"
  aria-labelledby="ginasio"
  x-show="active=='ginasio'"
>
  <div class="mt-4 text-lg">
    {!! $championship->gym_place !!}

  </div>
</article>
<article
  class="mt-4 pb-4 border-b border-blue-700/20"
  aria-labelledby="infos_gerais"
  x-show="active=='infos_gerais'"
>
  <div class="mt-4 text-lg">
    {!! $championship->info !!}

  </div>
</article>
@if (!empty($championship->public_entrance))
<article
  class="mt-4 pb-4 border-b border-blue-700/20"
  aria-labelledby="entrada_publico"
  x-show="active=='entrada_publico'"
>
  <div class="mt-4 text-lg">
    {!! $championship->public_entrance !!}
  </div>
</article>
@endif
@if ($championship->phase == 'open_register')
<div class="mt-8 flex justify-center">
    <a
      href="{{ route('home.championships.create', ['championship' => $championship->code]) }}"
      class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800"
    >
      Inscreva-se agora mesmo
    </a>
  </div>
@elseif($championship->phase == 'fighting')
<div class="mt-8 flex justify-center">
  <a
    href="./chave_listagem.html"
    class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800"
  >
    Fique por dentro do chaveamento
  </a>
</div>
@elseif($championship->phase == 'finished')
<div class="mt-8 flex justify-center">
  <a
    href="./resultados.html"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
  >
    Veja os resultados
  </a>
</div>
@endif
</main>
@endsection
