@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Almacén</h2>
    <a href="{{ route('admin.warehouses.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.warehouses.update', $warehouse) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" class="form-control" required value="{{ $warehouse->name }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dirección</label>
                    <textarea name="address" class="form-control" rows="3">{{ $warehouse->address }}</textarea>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $warehouse->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Activo</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Actualizar almacén</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection