@extends('shop.layout')

@section('title', 'Pedido #' . $order->id)

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="color:#1a1a2e">
            <i class="bi bi-bag me-2" style="color:#E95A25"></i>Pedido #{{ $order->id }}
        </h2>
        <a href="{{ route('shop.orders.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Mis pedidos
        </a>
    </div>

    @php
        $badges = [
            'pending'    => ['color' => 'warning', 'icon' => 'clock',        'label' => 'Pendiente'],
            'processing' => ['color' => 'info',    'icon' => 'gear',         'label' => 'En proceso'],
            'completed'  => ['color' => 'success', 'icon' => 'check-circle', 'label' => 'Completado'],
            'cancelled'  => ['color' => 'danger',  'icon' => 'x-circle',     'label' => 'Cancelado'],
        ];
        $badge = $badges[$order->status] ?? ['color' => 'secondary', 'icon' => 'question', 'label' => $order->status];
    @endphp

    <div class="row g-4">
        <!-- Info del pedido -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Información</h5>
                    <div class="mb-3">
                        <p class="text-muted small mb-1">Estado</p>
                        <span class="badge bg-{{ $badge['color'] }} px-3 py-2">
                            <i class="bi bi-{{ $badge['icon'] }} me-1"></i>{{ $badge['label'] }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted small mb-1">Fecha</p>
                        <p class="fw-semibold mb-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted small mb-1">Dirección de envío</p>
                        <p class="fw-semibold mb-0">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Resumen</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">IVA</span>
                        <span>${{ number_format($order->tax, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5" style="color:#E95A25">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seguimiento -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Seguimiento</h5>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background-color:{{ in_array($order->status, ['pending','processing','completed']) ? '#E95A25' : '#dee2e6' }};min-width:40px">
                            <i class="bi bi-check text-white fw-bold"></i>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 small">Pedido recibido</p>
                            <p class="text-muted mb-0 small">{{ $order->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background-color:{{ in_array($order->status, ['processing','completed']) ? '#E95A25' : '#dee2e6' }};min-width:40px">
                            <i class="bi bi-gear text-white fw-bold"></i>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 small">En proceso</p>
                            <p class="text-muted mb-0 small">Preparando tu pedido</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background-color:{{ $order->status == 'completed' ? '#E95A25' : '#dee2e6' }};min-width:40px">
                            <i class="bi bi-truck text-white fw-bold"></i>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 small">Entregado</p>
                            <p class="text-muted mb-0 small">Pedido completado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius:16px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">Productos del pedido</h5>
                    <table class="table">
                        <thead>
                            <tr style="background:#f8f9fa">
                                <th class="py-3">Producto</th>
                                <th class="py-3">Precio unitario</th>
                                <th class="py-3">Cantidad</th>
                                <th class="py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr class="align-middle">
                                <td class="py-3 fw-semibold">{{ $item->product?->name ?? '—' }}</td>
                                <td class="py-3">${{ number_format($item->price, 2) }}</td>
                                <td class="py-3">{{ $item->quantity }}</td>
                                <td class="py-3 fw-bold" style="color:#E95A25">${{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection