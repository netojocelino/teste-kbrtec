@extends('admin.layouts.master')


@section('content')
    <div class="d-flex align-items-end justify-content-between mb-4">
        <h1 class="h3">Editar Usuário</h1>

        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Voltar</a>
    </div>

    <form action="{{ route('profile.save') }}" class="bg-custom rounded col-12 py-3 px-4" method="POST">
        @csrf
        @method('post')

        @error('message')
        <div class="mb-3 row">
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        </div>
        @enderror

        @if(session('success'))
        <div class="mb-3 row">
            <small class="bg-success rounded py-1 px-2 mt-1 d-block text-light">{{ session('success')  }}</small>
        </div>
        @endif

        <div class="mb-3 row">
            <label for="usuario" class="col-sm-2 col-form-label">Usuário:</label>
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control bg-dark text-light border-dark"
                    id="usuario"
                    placeholder="Ex: Admin"
                    name="name"
                    readonly
                    value="{{ $user->name }}">
                @error('name')
                    <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
            <div class="col-sm-10">
                <input
                    type="email"
                    class="form-control bg-dark text-light border-dark"
                    id="email"
                    name="email"
                    placeholder="Ex: admin@kbrtec.com.br"
                    readonly
                    value="{{ $user->email }}">
                @error('email')
                    <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="senha" class="col-sm-2 col-form-label">Senha:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control bg-dark text-light border-dark" name="password" id="senha">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="confSenha" class="col-sm-2 col-form-label">Confirmar Senha:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control bg-dark text-light border-dark" name="password_confirmation" id="confSenha">
            </div>
        </div>

        <div class="mb-3 row">
            @error('password')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>


        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Salvar</button>
        </div>
    </form>

    <div class="bg-custom rounded overflow-hidden">

    </div>
@endsection
