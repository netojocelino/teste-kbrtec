@extends('admin.layouts.master')

@pushOnce('css')
    <link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css">
@endPushOnce


@section('content')

<div class="d-flex align-items-end justify-content-between mb-4">
    <h1 class="h3">Alterar Campeonato</h1>

    <a href="painel.html" class="btn btn-light">Voltar</a>
</div>

<form
    action="{{ route('admin.championship.update', ['championship' => $championship->id]) }}"
    class="bg-custom rounded col-12 py-3 px-4"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

    <div class="mb-3 row">
        @error('message')
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        @enderror
    </div>


    <div class="row mb-4">
        <div class="col-12 col-sm-4">
            <img
            src="{{ $championship->cover }}"
            name="preview_image"
            id="preview_image"
            for="image"
            class="img-responsive my-0 mx-auto"
            style="max-width: 400px; max-height: 200px;" />
        </div>

        <div class="col-12 col-sm-8">
            <x-input-text
                label="Código:"
                placeholder="Ex: CAMP-2023-001"
                name="code"
                :readonly="true"
                value="{{ $championship->code }}"
                />

                <x-input-text
                    label="Título:"
                    placeholder="Ex: Campeonato interno da KBRTec"
                    name="title"
                    :required="true"
                    value="{{ $championship->title }}"
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
                            >
                        @error('image')
                            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

        </div>
    </div>



    <x-input-text
        label="Cidade e Estado"
        name="city_state"
        readonly="true"
        value="{{ $championship->city_state }}"
    />

    <x-input-text
        label="Data de Realização"
        type="date"
        name="date"
        required="true"
        value="{{ $championship->dateInput }}"
    />

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            Sobre
            <sup class="text-danger" title="obrigatório">*</sup>
        </label>
        <div class="col-sm-10 text-dark">
            <textarea name="about">{!! $championship->about !!}</textarea>
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
            <textarea name="gym_place">{!! $championship->gym_place !!}</textarea>
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
            <textarea name="info">{!! $championship->info !!}</textarea>
            @error('info')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Entrada ao Público</label>
        <div class="col-sm-10 text-dark">
            <textarea name="public_entrance"></textarea>
            @error('public_entrance')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <x-input-select
        label="Tipo:"
        name="type"
        placeholder="Tipo de competição"
        required="true"
        :value="$championship->type"
        :options="[
            ['id' => 'kimono', 'value' => 'Kimono'],
            ['id' => 'no-gi', 'value' => 'No-Gi'],
        ]"
    />

    <x-input-select
        label="Fase:"
        name="phase"
        placeholder="Fase atual competição"
        required="true"
        :value="$championship->phase"
        :options="[
            ['id' => 'open_register', 'value' => 'Inscrições Abertas'],
            ['id' => 'fighting', 'value' => 'Chaves de Lutas'],
            ['id' => 'finished', 'value' => 'Resultados'],
        ]"
    />


    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-light">Atualizar</button>
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
