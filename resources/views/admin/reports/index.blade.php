@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Panel de Reportes</h2>
    <span class="text-muted">{{ now()->format('d/m/Y') }}</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Ventas totales</p>
                        <h4 class="fw-bold" style="color:#E95A25">${{ number_format($totalSales, 2) }}</h4>
                    </div>
                    <i class="bi bi-currency-dollar fs-1 text-muted"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total pedidos</p>
                        <h4 class="fw-bold">{{ $totalOrders }}</h4>
                    </div>
                    <i class="bi bi-cart fs-1 text-muted"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Clientes</p>
                        <h4 class="fw-bold">{{ $totalCustomers }}</h4>
                    </div>
                    <i class="bi bi-people fs-1 text-muted"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Productos</p>
                        <h4 class="fw-bold">{{ $totalProducts }}</h4>
                    </div>
                    <i class="bi bi-box fs-1 text-muted"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Ventas últimos 6 meses</h5>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Pedidos por estado</h5>
                <canvas id="statusChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Productos más vendidos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Unidades vendidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $item)
                        <tr>
                            <td>{{ $item->product?->name ?? '—' }}</td>
                            <td><span class="badge bg-success">{{ $item->total_sold }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">Sin datos</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Últimos pedidos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer?->name ?? '—' }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                                @php
                                    $badges = [
                                        'pending'    => 'warning',
                                        'processing' => 'info',
                                        'completed'  => 'success',
                                        'cancelled'  => 'danger',
                                    ];
                                    $badge = $badges[$order->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ ucfirst($order->status) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Sin pedidos</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($salesByMonth->pluck('month')) !!},
            datasets: [{
                label: 'Ventas ($)',
                data: {!! json_encode($salesByMonth->pluck('total')) !!},
                backgroundColor: '#E95A25',
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($ordersByStatus->pluck('status')) !!},
            datasets: [{
                data: {!! json_encode($ordersByStatus->pluck('total')) !!},
                backgroundColor: ['#ffc107', '#0dcaf0', '#198754', '#dc3545'],
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection