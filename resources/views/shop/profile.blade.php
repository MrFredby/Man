@extends('shop.layout')

@section('title', 'Mi perfil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4">Mi perfil</h2>

        <div class="row g-4">
            <!-- Datos personales -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-3">Datos personales</h5>
                        <form action="{{ route('shop.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nombre *</label>
                                <input type="text" name="name" class="form-control" required value="{{ $customer->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required value="{{ $customer->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
                            </div>
                            <hr>
                            <h5 class="mb-3">Cambiar contraseña</h5>
                            <div class="mb-3">
                                <label class="form-label">Nueva contraseña <small class="text-muted">(dejar vacío para no cambiar)</small></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Resumen -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-circle" style="font-size:5rem; color:#E95A25"></i>
                        <h5 class="mt-3">{{ $customer->name }}</h5>
                        <p class="text-muted">{{ $customer->email }}</p>
                        @if($customer->group)
                            <span class="badge bg-success">{{ $customer->group->name }}</span>
                            <p class="text-muted mt-2 small">Descuento: {{ $customer->group->discount_percent }}%</p>
                        @else
                            <span class="badge bg-secondary">Sin grupo</span>
                        @endif
                        <hr>
                        <a href="{{ route('shop.orders.index') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-cart me-1"></i> Mis pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection