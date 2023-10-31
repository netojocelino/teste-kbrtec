@extends('admin.layouts.master')


@section('content')

<div class="d-flex align-items-end justify-content-between mb-4">
    <h1 class="h3">Cadastrar Usuário</h1>

    <a href="painel.html" class="btn btn-light">Voltar</a>
</div>

<form action="{{ route('admin.users.store') }}" class="bg-custom rounded col-12 py-3 px-4" method="POST">
    @csrf
    <div class="mb-3 row">
        @error('message')
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        @enderror
    </div>

    <div class="mb-3 row">
        <label for="usuario" class="col-sm-2 col-form-label">Usuário:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control bg-dark text-light border-dark" id="usuario" placeholder="Ex: Admin" name="name" value="{{ old('name') }}">
            @error('name')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label">Nível de acesso:</label>
        <div class="col-sm-10">
            <select name="role" id="role" class="form-control bg-dark text-light border-dark">
                <option value="">Nível de Acesso</option>
                <option @selected(old('role') == 'visitor') value="visitor">Usuários</option>
                <option @selected(old('role') == 'admin') value="admin">Administrador</option>
            </select>
            @error('role')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control bg-dark text-light border-dark" id="email" name="email" placeholder="Ex: admin@kbrtec.com.br" value="{{ old('email') }}">
            @error('email')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="senha" class="col-sm-2 col-form-label">Senha:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control bg-dark text-light border-dark" name="password" id="senha" value="{{ old('password') }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="confSenha" class="col-sm-2 col-form-label">Confirmar Senha:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control bg-dark text-light border-dark" name="password_confirmation" id="confSenha" value="{{ old('password_confirmation') }}">
        </div>
    </div>

    <div class="mb-3 row">
        @error('password')
            <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message  }}</small>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-light">Cadastrar</button>
    </div>
</form>

<div class="bg-custom rounded overflow-hidden">

</div>
@endsection
