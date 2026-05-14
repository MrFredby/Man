@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Descuento</h2>
    <a href="{{ route('admin.discounts.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.discounts.update', $discount) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Código de cupón</label>
                    <input type="text" name="code" class="form-control" value="{{ $discount->code }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo *</label>
                    <select name="type" class="form-select" required>
                        <option value="percent" {{ $discount->type == 'percent' ? 'selected' : '' }}>Porcentaje (%)</option>
                        <option value="fixed"   {{ $discount->type == 'fixed'   ? 'selected' : '' }}>Fijo ($)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Valor *</label>
                    <input type="number" name="value" class="form-control" step="0.01" min="0" required value="{{ $discount->value }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Grupo de clientes</label>
                    <select name="customer_group_id" class="form-select">
                        <option value="">— Todos —</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ $discount->customer_group_id == $group->id ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cantidad mínima</label>
                    <input type="number" name="min_quantity" class="form-control" min="0" value="{{ $discount->min_quantity }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha inicio</label>
                    <input type="datetime-local" name="starts_at" class="form-control" value="{{ $discount->starts_at }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha vencimiento</label>
                    <input type="datetime-local" name="expires_at" class="form-control" value="{{ $discount->expires_at }}">
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $discount->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Activo</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Actualizar descuento</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection