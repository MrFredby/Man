@extends('shop.layout')

@section('title', 'Mis pedidos')

@section('content')
<h2 class="mb-4">Mis pedidos</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
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
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>
                        <a href="{{ route('shop.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Ver detalle
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No tienes pedidos aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection