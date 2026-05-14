@extends('shop.layout')

@section('title', 'Carrito')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1a1a2e">
        <i class="bi bi-cart3 me-2" style="color:#E95A25"></i>Carrito de compras
    </h2>

    @if(count($cart) > 0)
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr style="background:#f8f9fa">
                                <th class="ps-4 py-3">Producto</th>
                                <th class="py-3">Precio</th>
                                <th class="py-3">Cantidad</th>
                                <th class="py-3">Subtotal</th>
                                <th class="py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                            <tr class="align-middle">
                                <td class="ps-4 py-3">
                                    <a href="{{ route('shop.products.show', $item['slug']) }}" class="text-decoration-none fw-semibold" style="color:#1a1a2e">
                                        {{ $item['name'] }}
                                    </a>
                                </td>
                                <td class="py-3" style="color:#E95A25;font-weight:600">${{ number_format($item['price'], 2) }}</td>
                                <td class="py-3">
                                    <form action="{{ route('shop.cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <div class="input-group" style="width:120px">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center" style="padding:6px">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="py-3 fw-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="py-3">
                                    <form action="{{ route('shop.cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" style="width:32px;height:32px;padding:0">
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
            <div class="card border-0 shadow-sm mt-3" style="border-radius:16px">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-tag me-2" style="color:#E95A25"></i>Cupón de descuento</h6>
                    @if($discount)
                        <div class="alert alert-success d-flex justify-content-between align-items-center mb-0" style="border-radius:10px">
                            <span><i class="bi bi-check-circle me-2"></i>Cupón <strong>{{ $discount['code'] }}</strong> aplicado</span>
                            <form action="{{ route('shop.coupon.remove') }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('shop.coupon.apply') }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="text" name="code" class="form-control" placeholder="Ingresa tu código">
                            <button type="submit" class="btn btn-primary px-4">Aplicar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Resumen -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Resumen del pedido</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    @if($discount)
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span><i class="bi bi-tag me-1"></i>Descuento</span>
                        <span class="fw-semibold">-${{ number_format($discountAmount, 2) }}</span>
                    </div>
                    @endif
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5" style="color:#E95A25">${{ number_format($total, 2) }}</span>
                    </div>
                    @if(session('customer'))
                        <a href="{{ route('shop.checkout') }}" class="btn btn-primary w-100 btn-lg mb-2">
                            <i class="bi bi-credit-card me-2"></i>Proceder al pago
                        </a>
                    @else
                        <a href="{{ route('shop.login') }}" class="btn btn-primary w-100 btn-lg mb-2">
                            <i class="bi bi-person me-2"></i>Iniciar sesión para comprar
                        </a>
                    @endif
                    <a href="{{ route('shop.products.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-left me-1"></i>Seguir comprando
                    </a>
                </div>
            </div>

            <!-- Beneficios -->
            <div class="card border-0 shadow-sm mt-3" style="border-radius:16px">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <i class="bi bi-shield-check fs-4" style="color:#E95A25"></i>
                        <div>
                            <p class="fw-semibold mb-0 small">Compra segura</p>
                            <p class="text-muted mb-0 small">Tus datos están protegidos</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-truck fs-4" style="color:#E95A25"></i>
                        <div>
                            <p class="fw-semibold mb-0 small">Envío rápido</p>
                            <p class="text-muted mb-0 small">Entrega en 24-48 horas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-cart-x" style="font-size:6rem;color:#dee2e6"></i>
        <h4 class="mt-4 fw-bold" style="color:#1a1a2e">Tu carrito está vacío</h4>
        <p class="text-muted mb-4">Agrega productos para comenzar tu compra</p>
        <a href="{{ route('shop.products.index') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-grid me-2"></i>Ver productos
        </a>
    </div>
    @endif
</div>
@endsection