@extends('admin.layouts.master')


@section('content')
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Campeonatos</h1>

    <div class="d-flex gap-2">
        @if ($championship->phase == 'fighting')
            <a data-event-finish="{{ $championship->id }}" class="btn btn-light">Finalizar Campeonato</a>
        @elseif ($championship->phase == 'finished')
            {{-- <a href="#" class="btn btn-light" title="PDF">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                </svg>
            </a> --}}

            <a href="{{ route('download.csv', ['championship_id' => $championship->id]) }}" class="btn btn-light" title="Excel">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                    <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
            </a>
        @endif
    </div>
</div>

<div class="bg-custom rounded overflow-hidden">
    <table class="table mb-0 table-custom table-dark align-middle">
        <thead>
            <tr>
                <th scope="col" class="text-uppercase">Luta</th>
                <th scope="col" class="text-uppercase">Fase</th>
                <th scope="col" class="text-uppercase">Atletas</th>
                <th scope="col" class="text-uppercase">Vencedor</th>
                <th scope="col" class="text-uppercase text-center">Ações</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($championship->groups as $item)
            <tr>
                <td>
                    # {{ $item->match_number }}
                </td>
                <td>{{ $item->match_level }}</td>
                <td>
                    {{ $item->firstAthlete->full_name }}
                    &times;
                    {{ optional($item->secondAthlete)->full_name ?? '-' }}
                </td>
                <td>
                    {{ optional($item->winner)->full_name ?? '-' }}
                </td>
                <td>
                    <div class="d-flex justify-content-center">

                        @if (!is_null($item->first_athlete_id) && is_null($item->winner_athlete_id))
                        <a
                            class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2"
                            title="Escolher campeão"
                            data-event-winner="{{ $item->first_athlete_id }}"
                            data-event-winner-name="{{ optional($item->firstAthlete)->full_name ?? '-' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z"/>
                            </svg>
                        </a>
                        @endif

                        @if (!is_null($item->second_athlete_id) && is_null($item->winner_athlete_id))
                        <a
                            class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2"
                            title="Escolher campeão"
                            data-event-winner="{{ $item->second_athlete_id }}"
                            data-event-winner-name="{{ optional($item->secondAthlete)->full_name ?? '-' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z"/>
                            </svg>
                        </a>
                        @endif

                    </div>
                </td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>

@endsection


@pushOnce('js')
<script>

    function polyfillFindDataset (element, dataAttr, deepMax = 5)
    {
        let deepNode = 0
        let findAttribute = false
        let elementWithDataAttr = element.target

        while (deepNode < deepMax && !findAttribute)
        {
            findAttribute = elementWithDataAttr.dataset[dataAttr] !== undefined
            if (!findAttribute) {
                elementWithDataAttr = elementWithDataAttr.parentNode
                deepNode++
            }
        }

        return elementWithDataAttr
    }

    function addWinnerEvent (e) {
        e.preventDefault()

        const btn = polyfillFindDataset(e, 'eventWinner')
        if (!btn.dataset.eventWinner) {
            alert('Ocorreu um erro, id não acessível')
        }

        const url = "{{ route('admin.championship.event.mark-winner', ['championship' => $championship->id, 'athlete_id' => '_REPLACE_']) }}".replace('_REPLACE_', btn.dataset.eventWinner)

        if (confirm(`Deseja marcar ${btn.dataset.eventWinnerName} como vencedor desta luta?`)) {
            http.put(url)
                .then((response) => {
                    alert('Vencedor escolhido com sucesso')
                    return window.location.reload()
                })
                .catch(error => {
                    return alert(error)
                })
        }
    }


    function addFinishFight (e) {
        e.preventDefault()

        const btn = polyfillFindDataset(e, 'eventFinish')
        if (!btn.dataset.eventFinish) {
            alert('Ocorreu um erro, id não acessível')
        }

        const url = "{{ route('admin.championship.events.finish', ['championship' => '_REPLACE_']) }}".replace('_REPLACE_', btn.dataset.eventFinish)

        if (confirm('Deseja finalizar a fase de grupos deste campeonato?')) {
            http.put(url)
                .then((response) => {
                    alert('Campeonato finalizado com sucesso')
                    return window.location.reload()
                })
                .catch(error => {
                    return alert(error)
                })
        }
    }

    document.querySelectorAll('[data-event-winner]').forEach(el => el.addEventListener('click', addWinnerEvent))
    document.querySelectorAll('[data-event-finish]').forEach(el => el.addEventListener('click', addFinishFight))
</script>
@endPushOnce
