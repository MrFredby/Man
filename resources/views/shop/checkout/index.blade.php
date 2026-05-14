@extends('shop.layout')

@section('title', 'Checkout')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1a1a2e">
        <i class="bi bi-credit-card me-2" style="color:#E95A25"></i>Finalizar compra
    </h2>

    <div class="row g-4">
        <!-- Formulario -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">
                        <i class="bi bi-geo-alt me-2" style="color:#E95A25"></i>Datos de envío
                    </h5>
                    <form action="{{ route('shop.checkout.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nombre</label>
                                <input type="text" class="form-control" value="{{ session('customer.name') }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Email</label>
                                <input type="text" class="form-control" value="{{ session('customer.email') }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small">Dirección de envío *</label>
                                <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Calle, número, colonia, ciudad, estado, CP..."></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-3" style="color:#1a1a2e">
                            <i class="bi bi-credit-card me-2" style="color:#E95A25"></i>Método de pago
                        </h5>
                        <div class="card border p-3 mb-3" style="border-radius:10px;border-color:#E95A25 !important">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-cash-coin fs-4" style="color:#E95A25"></i>
                                <div>
                                    <p class="fw-semibold mb-0">Pago contra entrega</p>
                                    <p class="text-muted small mb-0">Paga cuando recibas tu pedido</p>
                                </div>
                                <i class="bi bi-check-circle-fill ms-auto" style="color:#E95A25"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg mt-3">
                            <i class="bi bi-check-circle me-2"></i>Confirmar pedido
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Resumen -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Resumen del pedido</h5>
                    @foreach($cart as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="fw-semibold mb-0 small">{{ $item['name'] }}</p>
                            <p class="text-muted mb-0 small">x{{ $item['quantity'] }}</p>
                        </div>
                        <span class="fw-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    @if($discount)
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span><i class="bi bi-tag me-1"></i>{{ $discount['code'] }}</span>
                        <span>-${{ number_format($discountAmount, 2) }}</span>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">IVA (16%)</span>
                        <span>${{ number_format($tax, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5" style="color:#E95A25">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Seguridad -->
            <div class="card border-0 shadow-sm mt-3" style="border-radius:16px">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <i class="bi bi-shield-lock fs-4" style="color:#E95A25"></i>
                        <div>
                            <p class="fw-semibold mb-0 small">Compra 100% segura</p>
                            <p class="text-muted mb-0 small">Tus datos están protegidos</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-arrow-return-left fs-4" style="color:#E95A25"></i>
                        <div>
                            <p class="fw-semibold mb-0 small">Garantía de devolución</p>
                            <p class="text-muted mb-0 small">30 días para devolver</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection