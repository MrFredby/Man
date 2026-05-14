@extends('shop.layout')

@section('title', 'Mis pedidos')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1a1a2e">
        <i class="bi bi-bag me-2" style="color:#E95A25"></i>Mis pedidos
    </h2>

    @if($orders->count() > 0)
    <div class="row g-4">
        @foreach($orders as $order)
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <p class="text-muted small mb-1">Pedido</p>
                            <h5 class="fw-bold mb-0" style="color:#E95A25">#{{ $order->id }}</h5>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted small mb-1">Fecha</p>
                            <p class="fw-semibold mb-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted small mb-1">Estado</p>
                            @php
                                $badges = [
                                    'pending'    => ['color' => 'warning', 'icon' => 'clock', 'label' => 'Pendiente'],
                                    'processing' => ['color' => 'info',    'icon' => 'gear',  'label' => 'En proceso'],
                                    'completed'  => ['color' => 'success', 'icon' => 'check-circle', 'label' => 'Completado'],
                                    'cancelled'  => ['color' => 'danger',  'icon' => 'x-circle', 'label' => 'Cancelado'],
                                ];
                                $badge = $badges[$order->status] ?? ['color' => 'secondary', 'icon' => 'question', 'label' => $order->status];
                            @endphp
                            <span class="badge bg-{{ $badge['color'] }} px-3 py-2">
                                <i class="bi bi-{{ $badge['icon'] }} me-1"></i>{{ $badge['label'] }}
                            </span>
                        </div>
                        <div class="col-md-2">
                            <p class="text-muted small mb-1">Total</p>
                            <h5 class="fw-bold mb-0" style="color:#1a1a2e">${{ number_format($order->total, 2) }}</h5>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ route('shop.orders.show', $order) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>Ver detalle
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-bag-x" style="font-size:6rem;color:#dee2e6"></i>
        <h4 class="mt-4 fw-bold" style="color:#1a1a2e">No tienes pedidos aún</h4>
        <p class="text-muted mb-4">Explora nuestros productos y realiza tu primera compra</p>
        <a href="{{ route('shop.products.index') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-grid me-2"></i>Ver productos
        </a>
    </div>
    @endif
</div>
@endsection