@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Agregar Inventario</h2>
    <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.inventory.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Producto *</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">— Seleccionar —</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Almacén *</label>
                    <select name="warehouse_id" class="form-select" required>
                        <option value="">— Seleccionar —</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stock *</label>
                    <input type="number" name="stock" class="form-control" min="0" required value="{{ old('stock') }}">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Guardar inventario</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection