@extends('admin.layouts.master')


@section('content')

<div class="d-flex align-items-end justify-content-between mb-4">
    <h1 class="h3">Cadastrar Usuário</h1>

    <a href="painel.html" class="btn btn-light">Voltar</a>
</div>

<form action="{{ route('admin.championship.store') }}" class="bg-custom rounded col-12 py-3 px-4" method="POST">
    @csrf
    <div class="mb-3 row">
        @error('message')
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        @enderror
    </div>

    <x-input-text
        label="Código do Campeonato:"
        placeholder="Ex: CAMP-2023-001"
        name="code"
        value="{{ old('code') }}"
    />

    <x-input-text
        label="Título do Campeonato:"
        placeholder="Ex: Campeonato interno da KBRTec"
        name="title"
        value="{{ old('title') }}"
    />



    <x-input-text
        label="Imagem @TODO:"
        placeholder="Ex: Campeonato interno da KBRTec"
        name="title"
        value="{{ old('title') }}"
    />


    <div class="mb-3 row">
        <label for="state_id" class="col-sm-2 col-form-label">Estado:</label>
        <div class="col-sm-10">
            <select name="state_id" id="state_id" class="form-control bg-dark text-light border-dark">
                <option value="">Estado</option>
                @foreach ($states as $state)
                    <option @selected(old('state_id') == $state->id) value="{{$state->id}}">{{ $state->name }}</option>
                @endforeach
            </select>
            @error('state_id')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="city_id" class="col-sm-2 col-form-label">Cidade:</label>
        <div class="col-sm-10">
            <select name="city_id" id="city_id" class="form-control bg-dark text-light border-dark">
                <option value="">Cidade</option>
            </select>
            @error('city_id')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Data de Realização</label>
        <div class="col-sm-10">
            <input
                type="date"
                class="form-control bg-dark text-light border-dark"
                name="date"
                value="{{ old('date') }}">
            @error('date')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>



    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-light">Cadastrar</button>
    </div>
</form>

<div class="bg-custom rounded overflow-hidden">

</div>
@endsection



@pushOnce('js')
<script>

    let getDebounce = null

    function addChangeStateEvent (e) {
        e.preventDefault()

        if (getDebounce != null) {
            clearTimeout(getDebounce)
        }

        getDebounce = setTimeout(() => {
            const state_id = this.value

            if (!state_id) {
                alert('Ocorreu um erro, id não acessível')
            }

            const url = "{{ route('api.list-cities-from-state', ['state' => '_REPLACE_']) }}".replace('_REPLACE_', state_id)

            http.get(url)
                .then((response) => {
                    const $select = document.querySelector('[name=city_id]')

                    $select.innerHTML = '<option value="">Cidade</option>'

                    response.forEach(item => {
                        $select.innerHTML += `<option value="${item.id}">${item.name}</option>`
                    });
                })
                .catch(error => {

                    console.error(error)
                })
        }, 700);

    }

    document.querySelector('[name=state_id]').addEventListener('change', addChangeStateEvent)
</script>

@endPushOnce
