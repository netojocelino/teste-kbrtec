@props([
    'championship',
])

<article
    class="relative w-full rounded-xl overflow-hidden shadow-xl p-2 outline outline-1 outline-gray-400 text-gray-900 hover:-translate-y-2 transition-transform duration-300">
    <img src="{{ $championship->cover }}" alt="{{ $championship->title }}" title="{{ $championship->title }}"
        class="rounded-md w-full h-[200px] object-cover" />
    <div class="p-3 relative">
        <div class="absolute -top-14 bg-white px-4 py-2 rounded-md shadow-md shadow-gray-500 text-center">
            <p class="text-2xl font-bold" data-calendar>{{ $championship->date->format('d') }}</p>
            <p>{{ __($championship->date->format('M')) }}</p>
        </div>
        @switch($championship->phase)
            @case('open_register')
                <p class="absolute -top-3 left-24 bg-green-600 px-3 text-white rounded-xl">{{ __($championship->phase) }}</p>
            @break

            @case('fighting')
                <p class="absolute -top-3 left-24 bg-yellow-600 px-3 text-white rounded-xl">{{ __($championship->phase) }}</p>
            @break

            @case('finished')
                <p class="absolute -top-3 left-24 bg-blue-600 px-3 text-white rounded-xl">{{ __($championship->phase) }}</p>
            @break
            @default
        @endswitch
        <h3 class="mt-4 uppercase text-xl min-h-[60px]">
            {{ $championship->title }}
        </h3>
        <p class="text-gray-400 flex gap-2 my-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
            {{ $championship->type }}
        </p>
        <p class="text-gray-400 flex gap-2 my-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            {{ $championship->city_state }}

        </p>
    </div>
    <a href="{{ route('home.championships.show', ['championship' => $championship->code]) }}"
        title="Saiba mais sobre {{ $championship->title }}" class="absolute inset-0"></a>
</article>
