@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pedido #{{ $order->id }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Información del pedido</h5>
                <p><strong>Cliente:</strong> {{ $order->customer?->name }}</p>
                <p><strong>Almacén:</strong> {{ $order->warehouse?->name ?? '—' }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Dirección:</strong> {{ $order->shipping_address ?? '—' }}</p>
                <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Resumen</h5>
                <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                <p><strong>Impuestos:</strong> ${{ number_format($order->tax, 2) }}</p>
                <h5><strong>Total:</strong> ${{ number_format($order->total, 2) }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Productos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product?->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection