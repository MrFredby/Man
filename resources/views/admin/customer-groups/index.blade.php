@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Grupos de Clientes</h2>
    <a href="{{ route('admin.customer-groups.create') }}" class="btn text-white" style="background-color:#E95A25">
        <i class="bi bi-plus-lg me-1"></i> Nuevo Grupo
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descuento</th>
                    <th>Clientes</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>
                        <strong>{{ $group->name }}</strong>
                        @if($group->description)
                            <br><small class="text-muted">{{ $group->description }}</small>
                        @endif
                    </td>
                    <td><span class="badge bg-success">{{ $group->discount_percent }}%</span></td>
                    <td><span class="badge bg-primary">{{ $group->customers_count }}</span></td>
                    <td>
                        @if($group->is_active)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.customer-groups.edit', $group) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.customer-groups.destroy', $group) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar grupo?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay grupos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection