@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Grupo de Clientes</h2>
    <a href="{{ route('admin.customer-groups.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.customer-groups.update', $customerGroup) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" class="form-control" required value="{{ $customerGroup->name }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Descuento (%) *</label>
                    <div class="input-group">
                        <input type="number" name="discount_percent" class="form-control" min="0" max="100" step="0.01" required value="{{ $customerGroup->discount_percent }}">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-control" rows="3">{{ $customerGroup->description }}</textarea>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $customerGroup->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Activo</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Actualizar grupo</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection