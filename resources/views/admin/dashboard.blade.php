@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <span class="text-muted">Bienvenido al panel de administración</span>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-box fs-1 text-warning"></i>
                <h5 class="mt-2">Productos</h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-warning mt-2">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-people fs-1 text-primary"></i>
                <h5 class="mt-2">Clientes</h5>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-primary mt-2">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-cart fs-1 text-success"></i>
                <h5 class="mt-2">Pedidos</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-success mt-2">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-building fs-1" style="color:#E95A25"></i>
                <h5 class="mt-2">Almacenes</h5>
                <a href="{{ route('admin.warehouses.index') }}" class="btn btn-sm mt-2" style="border-color:#E95A25;color:#E95A25">Ver todos</a>
            </div>
        </div>
    </div>
</div>
@endsection