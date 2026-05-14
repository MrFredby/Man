@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Inventario</h2>
    <a href="{{ route('admin.inventory.create') }}" class="btn text-white" style="background-color:#E95A25">
        <i class="bi bi-plus-lg me-1"></i> Agregar Inventario
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Almacén</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product?->name ?? '—' }}</td>
                    <td>{{ $item->warehouse?->name ?? '—' }}</td>
                    <td>
                        @if($item->stock <= 5)
                            <span class="badge bg-danger">{{ $item->stock }}</span>
                        @elseif($item->stock <= 20)
                            <span class="badge bg-warning text-dark">{{ $item->stock }}</span>
                        @else
                            <span class="badge bg-success">{{ $item->stock }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.inventory.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.inventory.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar registro?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No hay registros de inventario.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection