@extends('shop.layout')

@section('title', 'Iniciar sesión')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Iniciar sesión</h3>
                <form action="{{ route('shop.login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
                <hr>
                <p class="text-center mb-0">¿No tienes cuenta? <a href="{{ route('shop.register') }}">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</div>
@endsection