@extends('admin.layouts.master')

@pushOnce('css')
    <link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css">
@endPushOnce


@section('content')

<div class="d-flex align-items-end justify-content-between mb-4">
    <h1 class="h3">Cadastrar Campeonato</h1>

    <a href="painel.html" class="btn btn-light">Voltar</a>
</div>

<form
    action="{{ route('admin.championship.store') }}"
    class="bg-custom rounded col-12 py-3 px-4"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    <div class="mb-3 row">
        @error('message')
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        @enderror
    </div>

    <x-input-text
        label="Código:"
        placeholder="Ex: CAMP-2023-001"
        name="code"
        :required="true"
        value="{{ old('code') }}"
    />

    <x-input-text
        label="Título:"
        placeholder="Ex: Campeonato interno da KBRTec"
        name="title"
        :required="true"
        value="{{ old('title') }}"
    />

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            Imagem
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10">
            <input
                type="file"
                class="form-control bg-dark text-light border-dark"
                name="image"
                accept=".png, .jpg, .jpeg"
                required>
            @error('image')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>

        {{-- <div class="col-sm-10">
            <img name="preview_image" id="preview_image" class="img-responsive" style="max-width: 400px; max-height: 200px;" />
        </div> --}}
    </div>



    <div class="mb-3 row">
        <label for="state_id" class="col-sm-2 col-form-label">
            Estado:
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10">
            <select name="state_id" id="state_id" class="form-control bg-dark text-light border-dark" required>
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
        <label for="city_id" class="col-sm-2 col-form-label">
            Cidade:
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10">
            <select name="city_id" id="city_id" class="form-control bg-dark text-light border-dark" required>
                <option value="">Cidade</option>
            </select>
            @error('city_id')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            Data de Realização
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10">
            <input
                type="date"
                class="form-control bg-dark text-light border-dark"
                name="date"
                required
                value="{{ old('date') }}">
            @error('date')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            Sobre
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10 text-dark">
            <textarea name="about">{{old('about')}}</textarea>
            @error('about')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            Ginásio
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10 text-dark">
            <textarea name="gym_place">{{old('gym_place')}}</textarea>
            @error('gym_place')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            Informações Gerais
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10 text-dark">
            <textarea name="info">{{old('info')}}</textarea>
            @error('info')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Entrada ao Público</label>
        <div class="col-sm-10 text-dark">
            <textarea name="public_entrance">{{old('public_entrance')}}</textarea>
            @error('public_entrance')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">
            Tipo:
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10">
            <select name="type" id="type" class="form-control bg-dark text-light border-dark" required>
                <option value="">Tipo de competição</option>
                <option value="kimono">Kimono</option>
                <option value="no-gi">No-Gi</option>
            </select>
            @error('type')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="phase" class="col-sm-2 col-form-label">
            Fase:
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10">
            <select name="phase" id="phase" class="form-control bg-dark text-light border-dark" required>
                <option value="">Fase atual competição</option>
                <option value="open_register">Inscrições Abertas</option>
                <option value="fighting">Chaves de Lutas</option>
                <option value="finished">Resultados</option>
            </select>
            @error('phase')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script src="https://unpkg.com/jcrop@3.0.1/dist/jcrop.js"></script>

<script>

    let getDebounce = null
    let cropImage = null

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

    function addChangeImageEvent (elementName) {
        const element = document.querySelector(elementName)

        return (e) => {
            const [file] = e.target.files

            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    element.src = e.target.result
                }
                reader.readAsDataURL(file)
                if (cropImage) cropImage.destroy()

                if (element.id) {
                    cropImage = Jcrop.attach(element.id)
                    cropImage.removeClass('jcrop-image-stage')
                }

            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('[name=state_id]').addEventListener('change', addChangeStateEvent)
        document.querySelector('[name=image]').addEventListener('change', addChangeImageEvent("#preview_image"))

        const CKConfig = {
            toolbar: {
                items: [ 'undo', 'redo', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList' ]
            },
        }


        const initCKEditor = (element) => ClassicEditor.create(element, CKConfig )
                .catch( error => { console.error( error ); } );

        initCKEditor(document.querySelector( `[name="about"]` ))
        initCKEditor(document.querySelector( `[name="gym_place"]` ))
        initCKEditor(document.querySelector( `[name="info"]` ))
        initCKEditor(document.querySelector( `[name="public_entrance"]` ))
    })

</script>

@endPushOnce
