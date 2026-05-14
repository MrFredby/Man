@extends('shop.layout')

@section('title', 'Mi perfil')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1a1a2e">
        <i class="bi bi-person-circle me-2" style="color:#E95A25"></i>Mi perfil
    </h2>

    <div class="row g-4">
        <!-- Sidebar perfil -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center" style="border-radius:16px">
                <div class="card-body p-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white mx-auto mb-3" style="width:80px;height:80px;background-color:#E95A25;font-size:2rem;font-weight:700">
                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold">{{ $customer->name }}</h5>
                    <p class="text-muted small">{{ $customer->email }}</p>
                    @if($customer->group)
                        <span class="badge" style="background-color:#E95A25">{{ $customer->group->name }}</span>
                        <p class="text-muted small mt-2">Descuento: {{ $customer->group->discount_percent }}%</p>
                    @else
                        <span class="badge bg-secondary">Sin grupo</span>
                    @endif
                    <hr>
                    <a href="{{ route('shop.orders.index') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-bag me-2"></i>Mis pedidos
                    </a>
                    <a href="{{ route('shop.products.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-grid me-2"></i>Ver productos
                    </a>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Datos personales</h5>
                    <form action="{{ route('shop.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nombre *</label>
                                <input type="text" name="name" class="form-control" required value="{{ $customer->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Email *</label>
                                <input type="email" name="email" class="form-control" required value="{{ $customer->email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono</label>
                                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" placeholder="+52 33 1234 5678">
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="fw-bold mb-3" style="color:#1a1a2e">Cambiar contraseña</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nueva contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Dejar vacío para no cambiar">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la contraseña">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 px-5">
                            <i class="bi bi-check-circle me-2"></i>Guardar cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection