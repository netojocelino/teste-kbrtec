@extends('admin.layouts.master')


@section('content')
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Campeonatos</h1>

    <div class="d-flex gap-2">
        <a href="#" class="btn btn-light" title="PDF">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
            </svg>
        </a>

        <a href="#" class="btn btn-light" title="Excel">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>
        </a>

        <a href="{{ route('admin.championship.create') }}" class="btn btn-light">+ Cadastrar Campeonato</a>
    </div>
</div>

<div class="d-flex justify-content-between align-items-end mb-3">
    <form action="" class="bg-custom rounded col-12 py-3 px-4" method="GET">

        <div class="row align-items-end row-gap-4">
            <div class="col-3 d-flex flex-wrap">
                <label for="search" class="col-form-label">Buscar:</label>
                <div class="col-12">
                    <input type="text" name="name" class="form-control bg-dark text-light border-dark" id="search" placeholder="Ex: Admin" value="{{ data_get($search, 'name') }}">
                </div>
            </div>

            <div class="col-3 d-flex flex-wrap">
                <label for="status" class="col-form-label">Status:</label>
                <div class="col-12">
                    <select name="status" class="form-control bg-dark text-light border-dark form-select" id="status">
                        <option value="" disabled selected>Selecione</option>
                        <option @selected(data_get($search, 'status') == 'true') value="true">Ativado</option>
                        <option @selected(data_get($search, 'status') == 'false') value="false">Desativado</option>
                    </select>
                </div>
            </div>

            <div class="col-5 row">
                <div class="col-12 col-form-label">Data:</div>

                <div class="col-6 d-flex gap-2">
                    <label for="de" class="col-form-label">De:</label>
                    <input type="date" class="form-control bg-dark text-light border-dark" id="date_from" name="date_from" placeholder="27/10/2023" value="{{ data_get($search, 'date_from') }}">
                </div>

                <div class="col-6 d-flex gap-2">
                    <label for="ate" class="col-form-label">Até:</label>
                    <input type="date" class="form-control bg-dark text-light border-dark" id="date_to" name="date_to" placeholder="27/10/2023" value="{{ data_get($search, 'date_to') }}">
                </div>
            </div>

            <div class="col d-flex justify-content-end">
                <button type="submit" class="btn btn-light w-100">Filtrar</button>
            </div>
        </div>
    </form>
</div>


<div class="bg-custom rounded overflow-hidden">
    <table class="table mb-0 table-custom table-dark align-middle">
        <thead>
            <tr>
                <th scope="col" class="text-uppercase">código</th>
                <th scope="col" class="text-uppercase">Campeonato</th>
                <th scope="col" class="text-uppercase">tipo</th>
                <th scope="col" class="text-uppercase">fase</th>
                <th scope="col" class="text-uppercase">data</th>
                <th scope="col" class="text-uppercase text-center">Ações</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($championships as $item)
            <tr>
                <td>
                    <a href="{{ route('admin.championship.show', ['championship' => $item->id])}}" class="btn btn-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                        </svg>
                    </a>
                    {{ $item->code }}
                </td>
                <td>
                    <div class="d-flex flex-row gap-4">
                        <div>
                            <img src="{{ $item->cover }}" class="img-responsive" style="max-width: 100px;">
                        </div>
                        <div>
                            <p>{{ $item->title }}</p>
                            <div class="small text-white-50">
                                {!! $item->gym_place !!}
                            </div>
                            <p class="small text-white-50">
                                {{ $item->city_state }}
                            </p>
                            <div class="small text-white-50">{!! $item->info !!}</div>
                        </div>
                    </div>
                    {{ $item->email }}
                </td>
                <td>{{ $item->type }}</td>
                <td>{{ __($item->phase) }}</td>
                <td>{{ $item->DateFormated }}</td>
                <td>
                    <div class="d-flex justify-content-center">

                    @if ($item->feature_order)
                        <button type="button" class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" title="Marcar como destaque" data-feature-on="{{ $item->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-star-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z"/>
                            </svg>
                        </button>
                    @else
                        <button type="button" class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" title="Marcar como destaque" data-feature-on="{{ $item->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-star" viewBox="0 0 16 16">
                                <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                              </svg>
                        </button>
                    @endif

                        <a href="{{ route('admin.championship.edit', ['championship' => $item->id]) }}" class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path fill="#141618" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </a>

                        <a href="#" class="btn btn-danger d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" title="Deletar" data-delete-id="{{ $item->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path fill="#FFF" d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path fill="#FFF" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </a>

                        @if ($item->phase == 'open_register')
                        <button
                            title="Iniciar"
                            data-event-start="{{ $item->id }}"
                            type="button"
                            class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </button>
                        @elseif ($item->phase == 'fighting')
                        <button
                            title="Finalizar"
                            data-event-finish="{{ $item->id }}"
                            type="button"
                            class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                        </button>
                        @elseif ($item->phase == 'finished')
                        <button
                            title="Baixar"
                            data-event-download="{{ $item->id }}"
                            type="button"
                            class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z"/>
                            </svg>
                        </button>
                        @else
                        @endif
                    </div>
                </td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>

@include('pagination', ['paginator' => $championships])

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

    function addDeleteEvent (e) {
        e.preventDefault()

        const btn = polyfillFindDataset(e, 'deleteId')
        if (!btn.dataset.deleteId) {
            alert('Ocorreu um erro, id não acessível')
        }

        const url = "{{ route('admin.championship.destroy', ['championship' => '_REPLACE_']) }}".replace('_REPLACE_', btn.dataset.deleteId)

        if (confirm('Deseja apagar este campeonato?')) {
            http.delete(url)
                .then((response) => {
                    alert('Campeonato removido com sucesso')
                    return window.location.reload()
                })
                .catch(error => {
                    return alert(error)
                })
        }
    }

    function addFeatureEvent (e) {
        e.preventDefault()

        const btn = polyfillFindDataset(e, 'featureOn')
        if (!btn.dataset.featureOn) {
            alert('Ocorreu um erro, id não acessível')
        }

        const url = "{{ route('admin.championship.features.update', ['championship' => '_REPLACE_']) }}".replace('_REPLACE_', btn.dataset.featureOn)

        if (confirm('Deseja destacar este campeonato?')) {
            http.put(url)
                .then((response) => {
                    alert('Campeonato destacado com sucesso')
                    return window.location.reload()
                })
                .catch(error => {
                    return alert(error)
                })
        }
    }

    function addStartFight (e) {
        e.preventDefault()

        const btn = polyfillFindDataset(e, 'eventStart')
        if (!btn.dataset.eventStart) {
            alert('Ocorreu um erro, id não acessível')
        }

        const url = "{{ route('admin.championship.events.group', ['championship' => '_REPLACE_']) }}".replace('_REPLACE_', btn.dataset.eventStart)

        if (confirm('Deseja iniciar a fase de grupos deste campeonato?')) {
            http.put(url)
                .then((response) => {
                    alert('Campeonato iniciado com sucesso')
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


    function addDownloadFight (e) {
        e.preventDefault()

        const btn = polyfillFindDataset(e, 'download')
        if (!btn.dataset.download) {
            alert('Ocorreu um erro, id não acessível')
        }

        const url = "{{ route('admin.championship.events.group', ['championship' => '_REPLACE_']) }}".replace('_REPLACE_', btn.dataset.download)

        if (confirm('Deseja baixar o arquivo deste campeonato?')) {
            http.put(url)
                .then((response) => {
                    alert('Arquivo baixado sucesso')
                })
                .catch(error => {
                    return alert(error)
                })
        }
    }

    document.querySelectorAll('[data-delete-id]').forEach(el => el.addEventListener('click', addDeleteEvent))
    document.querySelectorAll('[data-feature-on]').forEach(el => el.addEventListener('click', addFeatureEvent))
    document.querySelectorAll('[data-event-start]').forEach(el => el.addEventListener('click', addStartFight))
    document.querySelectorAll('[data-event-finish]').forEach(el => el.addEventListener('click', addFinishFight))
    document.querySelectorAll('[data-event-download]').forEach(el => el.addEventListener('click', addDownloadFight))
</script>

@endPushOnce


{{-- @todo --}}
@pushOnce('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-light">
        <div class="modal-content bg-custom">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Campeonatos</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-wrap row-gap-4">
                <div class="col-6">
                    <div><small>Usuário:</small></div>
                    <div>Admin</div>
                </div>

                <div class="col-6">
                    <div><small>Status:</small></div>
                    <div>Ativado</div>
                </div>

                <div class="col-12">
                    <div><small>E-mail:</small></div>
                    <div>admin@kbrtec.com.br</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endPushOnce
