@extends('admin.layouts.athletes.public')

@section('content')

<main class="max-w-7xl mx-2 lg:mx-auto">
    <h2 class="text-center text-3xl text-blue-700 mt-4 mb-2">
        Chaveamento do torneio
    </h2>
    <p class="mb-6 text-center text-gray-900">
        Clique em uma categoria abaixo para ter mais detalhes
    </p>
    <section class="rounded-md outline outline-1 outline-gray-200 px-2 py-4">
        <h3 class="text-2xl text-center my-3">
            <span class="bg-yellow-900 px-3 rounded-md text-white">Faixa Marrom</span>
        </h3>
        <div class="flex gap-4">
            <div data-peso class="w-full">
                <h4 class="text-2xl text-gray-800 my-2">Peso Leve</h4>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'marrom', 'weight' => 'leve', 'gender' => 'masculino']) }}" class="py-4 pl-2 block w-full">
                            Masculino
                        </a>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'marrom', 'weight' => 'leve', 'gender' => 'feminino']) }}" class="py-4 pl-2 block w-full">
                            Feminino
                        </a>
                    </li>
                </ul>
            </div>
            <div data-peso class="w-full">
                <h4 class="text-2xl text-gray-800 my-2">Peso Pesado</h4>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'marrom', 'weight' => 'pesado', 'gender' => 'masculino']) }}" class="py-4 pl-2 block w-full">
                            Masculino
                        </a>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'marrom', 'weight' => 'pesado', 'gender' => 'feminino']) }}" class="py-4 pl-2 block w-full">
                            Feminino
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="mt-8 rounded-md outline outline-1 outline-gray-200 px-2 py-4">
        <h3 class="text-2xl text-center my-3">
            <span class="bg-black px-3 rounded-md text-white">Faixa Preta</span>
        </h3>
        <div class="flex gap-4">
            <div data-peso class="w-full">
                <h4 class="text-2xl text-gray-800 my-2">Peso Leve</h4>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'preta', 'weight' => 'leve', 'gender' => 'masculino']) }}" class="py-4 pl-2 block w-full">
                            Masculino
                        </a>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'preta', 'weight' => 'leve', 'gender' => 'feminino']) }}" class="py-4 pl-2 block w-full">
                            Feminino
                        </a>
                    </li>
                </ul>
            </div>
            <div data-peso class="w-full">
                <h4 class="text-2xl text-gray-800 my-2">Peso Pesado</h4>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'preta', 'weight' => 'pesado', 'gender' => 'masculino']) }}" class="py-4 pl-2 block w-full">
                            Masculino
                        </a>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <a href="{{ route('home.championships.view', ['championship' => $championship->id, 'belt' => 'preta', 'weight' => 'pesado', 'gender' => 'feminino']) }}" class="py-4 pl-2 block w-full">
                            Feminino
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

@endsection
