@extends('shop.layout')

@section('title', 'Carrito')

@section('content')
<h2 class="mb-4">Carrito de compras</h2>

@if(count($cart) > 0)
<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                        <tr>
                            <td>
                                <a href="{{ route('shop.products.show', $item['slug']) }}" class="text-decoration-none text-dark">
                                    {{ $item['name'] }}
                                </a>
                            </td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form action="{{ route('shop.cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width:70px">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </form>
                            </td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('shop.cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cupón -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h6>¿Tienes un cupón de descuento?</h6>
                @if($discount)
                    <div class="alert alert-success d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-tag me-2"></i>Cupón <strong>{{ $discount['code'] }}</strong> aplicado</span>
                        <form action="{{ route('shop.coupon.remove') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </div>
                @else
                    <form action="{{ route('shop.coupon.apply') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="code" class="form-control" placeholder="Código de cupón">
                        <button type="submit" class="btn btn-outline-primary">Aplicar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Resumen</h5>
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
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span style="color:#E95A25">${{ number_format($total, 2) }}</span>
                </div>
                <div class="mt-3">
                    @if(session('customer'))
                        <a href="{{ route('shop.checkout') }}" class="btn btn-primary w-100">
                            <i class="bi bi-credit-card me-1"></i> Proceder al pago
                        </a>
                    @else
                        <a href="{{ route('shop.login') }}" class="btn btn-primary w-100">
                            <i class="bi bi-person me-1"></i> Iniciar sesión para comprar
                        </a>
                    @endif
                    <a href="{{ route('shop.products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Seguir comprando
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="text-center py-5">
    <i class="bi bi-cart-x" style="font-size:5rem; color:#E95A25"></i>
    <h4 class="mt-3">Tu carrito está vacío</h4>
    <a href="{{ route('shop.products.index') }}" class="btn btn-primary mt-3">Ver productos</a>
</div>
@endif
@endsection