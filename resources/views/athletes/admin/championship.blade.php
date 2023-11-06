@extends('admin.layouts.athletes.public')

@section('content')
<div class="bg-blue-700">
    <div
      class="relative grid place-items-center max-w-7xl w-full mx-2 lg:mx-auto min-h-[200px]"
    >
      <div>
        <nav class="flex md:absolute left-0" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a
                href="{{ route('home') }}"
                class="inline-flex items-center text-sm font-medium text-white hover:text-blue-200"
              >
                <svg
                  class="w-3 h-3 mr-2.5"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                  />
                </svg>
                Início
              </a>
            </li>
            <li aria-current="page">
              <div class="flex items-center">
                <svg
                  class="w-3 h-3 text-gray-100 mx-1"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 9 4-4-4-4"
                  />
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-100 md:ml-2"
                  >Torneios</span
                >
              </div>
            </li>
          </ol>
        </nav>
        <h1 class="uppercase text-center text-white text-4xl">Torneios</h1>
      </div>
    </div>
  </div>
  <form
    class="rounded-lg shadow max-w-7xl m-4 md:mx-auto md:mt-4 outline outline-1 outline-gray-300 p-4 flex flex-col lg:flex-row gap-2"
  >
    <div class="flex-1">
      <label
        for="Título do evento"
        class="block mb-2 text-sm font-medium text-gray-900"
        >Título do evento</label
      >
      <input
        type="text"
        title="Título do evento"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="Nome do evento"
        required
        name="name"
        value="{{ data_get($search, 'name') }}"
      />
    </div>
    <div>
      <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900"
        >Tipo</label
      >
      <select
        id="tipo"
        name="type"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      >
        <option @if(!in_array(data_get($search, 'type', ''), ['kimono', 'no-gi'])) selected='selected' @endif value="">Escolha um tipo</option>
        <option @if(data_get($search, 'type') == 'kimono') selected='selected' @endif value="kimono">Kimono</option>
        <option @if(data_get($search, 'type',) =='no-gi') selected='selected' @endif value="no-gi">No Gi</option>
      </select>
    </div>
    <div>
      <label for="estado" class="block mb-2 text-sm font-medium text-gray-900"
        >Estado</label
      >
      <select
        id="estado"
        name="state"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      >
        <option @if(!in_array(data_get($search, 'state', ''), ['SP', 'RJ'])) selected='selected' @endif value="">Escolha um estado</option>
        <option @if(data_get($search, 'state') == 'SP') selected='selected' @endif value="SP">São Paulo</option>
        <option @if(data_get($search, 'state') == 'RJ') selected='selected' @endif value="RJ">Rio de Janeiro</option>
      </select>
    </div>
    <div>
      <label for="cidade" class="block mb-2 text-sm font-medium text-gray-900"
        >
        Cidade
        <sup class="text-danger">*</sup>
        </label
      >
      <input
        type="text"
        id="cidade"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="Cidade do torneio"
        required
        name="city"
        value="{{ data_get($search, 'city') }}"
      />
    </div>
    <div class="flex items-end">
      <button
        type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
      >
        Buscar
      </button>
    </div>
  </form>
  <main>
    <div class="grid lg:grid-cols-4 gap-3 max-w-7xl mx-2 lg:mx-auto">

        @foreach ($championships as $championship)
            <x-card.championship :championship="$championship" />
        @endforeach
    </div>


    @include('pagination', [
        'paginator' => $championships,
        'theme'     => 'public'
    ])
  </main>

@endsection
