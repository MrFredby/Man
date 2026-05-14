@extends('shop.layout')

@section('title', 'Checkout')

@section('content')
<h2 class="mb-4">Finalizar compra</h2>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5>Datos de envío</h5>
                <hr>
                <form action="{{ route('shop.checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="{{ session('customer.name') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{ session('customer.email') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección de envío *</label>
                        <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Calle, número, colonia, ciudad..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle me-1"></i> Confirmar pedido
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
<div class="col-md-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
                        <h5>Resumen del pedido</h5>
                        <hr>
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        @if($discount)
                        <div class="d-flex justify-content-between text-success">
                            <span>Descuento ({{ $discount['code'] }})</span>
                            <span>-${{ number_format($discountAmount, 2) }}</span>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <span>IVA (16%)</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span style="color:#E95A25">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection