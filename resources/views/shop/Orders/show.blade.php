@extends('shop.layout')

@section('title', 'Pedido #' . $order->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pedido #{{ $order->id }}</h2>
    <a href="{{ route('shop.orders.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Información</h5>
                <hr>
                <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Dirección:</strong> {{ $order->shipping_address }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Resumen</h5>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>IVA</span>
                    <span>${{ number_format($order->tax, 2) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span style="color:#E95A25">${{ number_format($order->total, 2) }}</span>
                </div>
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