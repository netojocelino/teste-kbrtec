@extends('admin.layouts.athletes.public')

@section('content')

<main class="max-w-7xl mx-2 lg:mx-auto">
    <h2 class="text-blue-700 text-center text-3xl my-4">Chaveamento</h2>
    <!-- Infos do torneio -->
    <div class="flex justify-center gap-2">
        <p class="text-center">
            <span class="bg-black px-3 rounded-md text-white">Faixa Preta</span>
        </p>
        <p class="flex items-center justify-center text-gray-500 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path
                    d="M240-200h480l-57-400H297l-57 400Zm240-480q17 0 28.5-11.5T520-720q0-17-11.5-28.5T480-760q-17 0-28.5 11.5T440-720q0 17 11.5 28.5T480-680Zm113 0h70q30 0 52 20t27 49l57 400q5 36-18.5 63.5T720-120H240q-37 0-60.5-27.5T161-211l57-400q5-29 27-49t52-20h70q-3-10-5-19.5t-2-20.5q0-50 35-85t85-35q50 0 85 35t35 85q0 11-2 20.5t-5 19.5ZM240-200h480-480Z"
                    fill="currentColor" />
            </svg>
            Peso Leve
        </p>
        <p class="flex items-center justify-center text-gray-500 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=""
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-gender-female" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z" />
            </svg>
            Masculino
        </p>
    </div>
    <div class="mt-4 flex gap-4">
        <!-- Round 1 -->
        <div class="flex flex-col justify-around gap-14 w-full">
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 1</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 2</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 3</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 4</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 5</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 6</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Round 2 -->
        <div class="flex flex-col justify-around gap-14 w-full">
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 7</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 8</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 9</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Round 3 -->
        <div class="flex flex-col justify-around gap-14 w-full">
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 10</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
                <div class="absolute border-b border-l border-black h-[350px] w-[100px] -right-8"></div>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">Disputa 11</p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
                <div class="border-r border-b border-black absolute top-8 -right-8 w-[200px] h-[40px] -z-10"></div>
            </div>
        </div>
        <!-- Round 4 -->
        <div class="flex flex-col justify-around gap-2 w-full py-32">
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">
                    Disputa 12 - Final
                </p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="relative isolate">
                <p class="absolute -top-6 text-gray-700 font-bold">
                    Disputa 13 - 3º lugar
                </p>
                <ul class="border-t-4 border-b-4 border-blue-700">
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-900">
                            Lutador 1
                            <span class="block text-blue-700 font-normal text-xs">Equipe Cobra Kai</span>
                        </p>
                    </li>
                    <li class="odd:bg-gray-200 even:bg-gray-100 flex items-stretch border-b border-gray-100">
                        <p class="p-2 block w-full text-sm font-bold text-gray-400">
                            Lutador 2
                            <span class="block text-blue-700 font-normal text-xs">Equipe Mugiwara</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>

@endsection
