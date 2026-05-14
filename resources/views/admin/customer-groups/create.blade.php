@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nuevo Grupo de Clientes</h2>
    <a href="{{ route('admin.customer-groups.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.customer-groups.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="Ej: Mayoristas, VIP, etc.">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Descuento (%) *</label>
                    <div class="input-group">
                        <input type="number" name="discount_percent" class="form-control" min="0" max="100" step="0.01" required value="{{ old('discount_percent', 0) }}">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Descripción del grupo...">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Activo</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Guardar grupo</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection