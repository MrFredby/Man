
@extends('shop.layout')

@section('title', 'Registro')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color:#1a1a2e">Crear cuenta</h2>
                <p class="text-muted">Regístrate gratis y empieza a comprar</p>
            </div>
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-5">
                    <form action="{{ route('shop.register.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" name="name" class="form-control border-start-0" required value="{{ old('name') }}" placeholder="Tu nombre">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-start-0" required value="{{ old('email') }}" placeholder="tu@email.com">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" required placeholder="Mínimo 6 caracteres">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirmar contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-muted"></i></span>
                                <input type="password" name="password_confirmation" class="form-control border-start-0" required placeholder="Repite tu contraseña">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                            <i class="bi bi-person-plus me-2"></i>Crear cuenta
                        </button>
                    </form>
                    <hr>
                    <p class="text-center mb-0">¿Ya tienes cuenta?
                        <a href="{{ route('shop.login') }}" style="color:#E95A25;font-weight:600">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection