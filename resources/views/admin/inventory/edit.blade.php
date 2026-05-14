@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Inventario</h2>
    <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.inventory.update', $inventory) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" value="{{ $inventory->product?->name }}" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Almacén</label>
                    <input type="text" class="form-control" value="{{ $inventory->warehouse?->name }}" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stock *</label>
                    <input type="number" name="stock" class="form-control" min="0" required value="{{ $inventory->stock }}">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Actualizar stock</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection