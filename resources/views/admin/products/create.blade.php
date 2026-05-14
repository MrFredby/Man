@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nuevo Producto</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Categoría *</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">— Seleccionar —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio *</label>
                    <input type="number" name="price" class="form-control" step="0.01" min="0" required value="{{ old('price') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio de oferta</label>
                    <input type="number" name="sale_price" class="form-control" step="0.01" min="0" value="{{ old('sale_price') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stock *</label>
                    <input type="number" name="stock" class="form-control" min="0" required value="{{ old('stock') }}">
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Activo</label>
                    </div>
                </div>
                <div class="col-md-12">
    <label class="form-label">Imagen del producto</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    <small class="text-muted">Formatos: JPG, PNG, WEBP. Máximo 2MB.</small>
</div>
                <div class="col-md-12">
                    <button type="submit" class="btn text-white" style="background-color:#E95A25">Guardar producto</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection