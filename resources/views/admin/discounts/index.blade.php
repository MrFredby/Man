@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Descuentos</h2>
    <a href="{{ route('admin.discounts.create') }}" class="btn text-white" style="background-color:#E95A25">
        <i class="bi bi-plus-lg me-1"></i> Nuevo Descuento
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Grupo</th>
                    <th>Vigencia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($discounts as $discount)
                <tr>
                    <td>{{ $discount->id }}</td>
                    <td>{{ $discount->code ?? '—' }}</td>
                    <td>{{ $discount->type == 'percent' ? 'Porcentaje' : 'Fijo' }}</td>
                    <td>{{ $discount->type == 'percent' ? $discount->value . '%' : '$' . number_format($discount->value, 2) }}</td>
                    <td>{{ $discount->customerGroup?->name ?? '—' }}</td>
                    <td>
                        @if($discount->expires_at)
                            {{ \Carbon\Carbon::parse($discount->expires_at)->format('d/m/Y') }}
                        @else
                            Sin vencimiento
                        @endif
                    </td>
                    <td>
                        @if($discount->is_active)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.discounts.edit', $discount) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar descuento?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay descuentos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection