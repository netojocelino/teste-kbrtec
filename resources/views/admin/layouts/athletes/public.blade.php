<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Patua+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <style>
        body { font-family: "Roboto", sans-serif; }

        h1, h2, h3, h4, h5, h6, [data-calendar] {
            font-family: "Patua One", serif;
        }

        #logo {
            text-transform: uppercase;
            font-size: 1.5rem;
            font-weight: bold;
            margin-left: 5px;
        }

        .debug {
            outline: 1px solid red;
        }
    </style>
    <title>Campeonato de Jiu Jitsu</title>
</head>

<body>
    <header>
        <nav class="bg-white border-gray-200">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('/img/logo.svg') }}" alt="Logo" />
                    <p id="logo">OSU BJJ</p>
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Abrir menu principal</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:items-center md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                        <li>
                            <a href="{{ route('home') }}"
                                class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0"
                                aria-current="page">Início</a>
                        </li>
                        <li>
                            <a href="../torneios.html"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Torneios</a>
                        </li>
                        <li>
                            <a href="./area_restrita.html"
                                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                                Área do competidor
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="bg-white rounded-lg shadow max-w-7xl m-4 md:mx-auto md:mt-4 outline outline-1 outline-gray-300">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2023 <a href="{{ route('home') }}" class="hover:underline">OSU BJJ</a>.
                Todos os
                direitos reservados.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 sm:mt-0">
                <li>
                    <a href="{{ route('home') }}" class="mr-4 hover:underline md:mr-6">Início</a>
                </li>
                <li>
                    <a href="../torneios.html" class="mr-4 hover:underline md:mr-6">Torneios</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Área do competidor</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Política de privacidade</a>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>
