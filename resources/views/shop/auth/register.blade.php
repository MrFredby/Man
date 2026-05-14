@extends('shop.layout')

@section('title', 'Registro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Crear cuenta</h3>
                <form action="{{ route('shop.register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre completo *</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar contraseña *</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
                </form>
                <hr>
                <p class="text-center mb-0">¿Ya tienes cuenta? <a href="{{ route('shop.login') }}">Inicia sesión</a></p>
            </div>
        </div>
    </div>
</div>
@endsection