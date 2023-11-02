@extends('admin.layouts.public')

@section('content')
<form action="{{ route('request-new-password') }}" class="form w-100" method="POST">
    @csrf

    @if ($errors->any())
        <div class="row bg-danger rounded py-1 px-2 mt-1 d-block text-light">
            @foreach ($errors->all() as $err)
                <small>{{$err}}</small>
            @endforeach
        </div>
    @endif

    <h2 class="h4 text-light">Esqueceu sua senha?</h2>
    <p class="mb-4 text-light fw-light">Apenans digite seu e-mail abaixo e enviaremos um link para ele para redefinir sua senha!</p>

    <div class="row row-gap-3">
        <div class="col-12 form-group text-light">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control bg-dark border-dark text-light" id="email" placeholder="example@kbrtec.com.br" name="email">
            @error('error')
                <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-12 mt-3 d-flex gap-2 align-items-center justify-content-between">
            <button type="submit" class="btn btn-light">Resetar senha</button>

            <a href="{{ route('login') }}" class="link-light">Voltar</a>
        </div>
    </div>
</form>
@endsection
