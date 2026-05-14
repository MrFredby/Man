@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Pedido #{{ $order->id }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Estado *</label>
                    <select name="status" class="form-select" required>
                        <option value="pending"    {{ $order->status == 'pending'    ? 'selected' : '' }}>Pendiente</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En proceso</option>
                        <option value="completed"  {{ $order->status == 'completed'  ? 'selected' : '' }}>Completado</option>
                        <option value="cancelled"  {{ $order->status == 'cancelled'  ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Almacén</label>
                    <select name="warehouse_id" class="form-select">
                        <option value="">— Sin almacén —</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $order->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Actualizar pedido</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection