@extends('admin.layouts.athletes.public')

@section('content')

<section class="relative h-[300px]">
    <img
      src="{{ $championship->cover }}"
      alt="{{ $championship->title }}"
      class="w-full h-full object-cover"
    />
    <div class="bg-black/70 grid place-items-center absolute inset-0">
      <div>
        <h1 class="text-center text-4xl text-white mt-4 mb-8">
            {{ $championship->title }}
        </h1>
        <div class="flex gap-2 justify-center text-sm">
          <p class="text-white flex items-center gap-2">
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
                d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5"
              />
            </svg>
            {{ $championship->code }}
          </p>
          <p class="text-white flex items-center gap-2">
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
            {{ $championship->type }}
          </p>
          <p class="text-white flex items-center gap-2">
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
            {{ $championship->city_state }}
          </p>
          <p class="text-white flex items-center gap-2">
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
                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"
              />
            </svg>
            <time datetime="{{ $championship->date->format('Y-m-d') }}">{{ $championship->date->format('d\/m\/Y') }}</time>
          </p>
        </div>
      </div>
    </div>
  </section>

<main class="max-w-7xl mx-2 lg:mx-auto">

    @if (session('success'))
    <div class="d-flex bg-green-400 px-4 py-2 my-2">
        <h6 class="text-slate-800">Successo</h6>

        <p class="text-slate-900">
            {{ session('success') }}
        </p>
    </div>
    @endif



    <!-- Inscrições abertas -->

    @if ($errors->any())
    <div class="d-flex bg-red-400 px-4 py-2 my-2">
        <h6 class="text-slate-800">Não foi possível realizar a inscrição</h6>

        @foreach ($errors->all() as $error)
        <p class="text-slate-900">{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <form class="py-12"
        action="{{ route('home.championships.store', [
            'championship' => $championship->code,
        ]) }}"
        method="POST"
    >
        @csrf
      <h2 class="text-center text-3xl text-blue-700 mt-4 mb-8">
        Formulário de inscrição para o torneio
      </h2>
      <div class="flex gap-4">
        <div class="w-full">
          <label for="nome" class="block mb-2 text-lg font-medium"
            >Nome</label
          >
          <input
            type="text"
            id="nome"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Seu nome"
            name="full_name"
            value="{{old('full_name')}}"
            required
          />
          @error('full_name') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
        <div class="w-full">
          <label for="nascimento" class="block mb-2 text-lg font-medium"
            >Data de nascimento</label
          >
          <input
            type="date"
            id="nascimento"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required
            name="birthdate"
            value="{{old('birthdate')}}"
          />
          @error('birthdate') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
      </div>
      <div class="mt-4 flex gap-4">
        <div class="w-full">
          <label for="cpf" class="block mb-2 text-lg font-medium">CPF</label>
          <input
            type="text"
            id="cpf"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="000.000.000-00"
            name="document_number"
            value="{{old('document_number')}}"
            required
          />
          @error('document_number') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
        <div class="w-full">
          <label for="email" class="block mb-2 text-lg font-medium"
            >E-mail</label
          >
          <input
            type="email"
            id="email"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Seu e-mail"
            required
            name="email"
            value="{{old('email')}}"
          />
          @error('email') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
      </div>
      <div class="mt-4 flex gap-4">
        <div class="w-full">
          <label for="genero" class="block mb-2 text-lg font-medium"
            >Gênero</label
          >
          <select
            id="genero"
            name="gender"
            value="{{old('gender')}}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          >
            <option selected value="">Escolha um gênero</option>
            <option value="male">Masculino</option>
            <option value="female">Feminino</option>
          </select>
          @error('gender') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
        <div class="w-full">
          <label for="equipe" class="block mb-2 text-lg font-medium"
            >Equipe</label
          >
          <input
            type="text"
            id="equipe"
            name="team"
            value="{{old('team')}}"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Sua equipe"
            required
          />
          @error('team') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
      </div>
      <div class="mt-4 flex gap-4">
        <div class="w-full">
          <label for="faixa" class="block mb-2 text-lg font-medium"
            >Faixa</label
          >
          <select
            id="faixa"
            name="belt"
            value="{{old('belt')}}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          >
            <option selected value="">Escolha uma faixa</option>
            <option value="brown">Marrom</option>
            <option value="black">Preta</option>
          </select>
          @error('belt') <small class="text-red-600">{{$message}}</small> @enderror

        </div>
        <div class="w-full">
          <label for="peso" class="block mb-2 text-lg font-medium"
            >Peso</label
          >
          <select
            id="peso"
            name="weight"
            value="{{old('weight')}}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          >
            <option selected value="">Escolha um peso</option>
            <option value="light">Leve</option>
            <option value="strong">Pesado</option>
          </select>
          @error('weight') <small class="text-red-600">{{$message}}</small> @enderror
        </div>
      </div>
      <div class="mt-4 flex gap-4">
        <div class="w-full">
          <label for="senha" class="block mb-2 text-lg font-medium"
            >Senha</label
          >
          <input
            type="password"
            id="senha"
            name="password"
            value="{{old('password')}}"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="**********"
            required
          />
        </div>
        <div class="w-full">
          <label for="confirmar_senha" class="block mb-2 text-lg font-medium"
            >Confirmar Senha</label
          >
          <input
            type="password"
            name="password_confirmation"
            value="{{old('password_confirmation')}}"
            id="confirmar_senha"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="**********"
            required
          />
          @error('password') <small class="text-red-600">{{$message}}</small> @enderror
          @error('password_confirmation') <small class="text-red-600">{{$message}}</small> @enderror

        </div>
      </div>
      <div class="mt-8 flex justify-center">
        <button
          type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          Inscreva-se agora mesmo
        </button>
      </div>
    </form>
  </main>
@endsection
