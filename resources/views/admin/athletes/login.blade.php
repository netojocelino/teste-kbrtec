@extends('admin.layouts.public')

@section('content')
<form action="{{ route('authenticate') }}" class="form w-100" method="POST">
    @csrf
    <h2 class="h4 text-light mb-4">Painel Administrativo</h2>

    @error('error')
    <small class="bg-danger rounded py-1 px-2 mt-1 mb-4 d-block text-light">Um erro ocorreu: {{ $message  }}</small>
    @enderror

    <div class="row row-gap-3">
        <div class="col-12 form-group text-light">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control bg-dark border-dark text-light" id="email" placeholder="example@kbrtec.com.br" name="email" value="{{old('email', request()->query('email'))}}">
            @error('email')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">Um erro ocorreu: {{ $message  }}</small>
            @enderror
        </div>

        <div class="col-12 form-group text-light">
            <label for="password">Senha:</label>
            <input type="password" class="form-control bg-dark border-dark text-light" id="password" name="password" value="{{ old('password')}}">
            @error('password')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">Um erro ocorreu: {{ $message  }}</small>
            @enderror

            <a href="{{ route('reset-password') }}" class="link-light"><small>Esqueci minha senha</small></a>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-light mt-3">Entrar</button>
        </div>
    </div>
</form>
@endsection
