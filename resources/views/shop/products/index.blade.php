@extends('shop.layout')

@section('title', 'Productos')

@section('content')
<div class="row">
    <!-- Filtros -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 mb-4">
            <h5>Filtrar</h5>
            <form action="{{ route('shop.products.index') }}" method="GET">
                <div class="mb-3">
                    <label class="form-label">Buscar</label>
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nombre del producto">
                </div>
                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <select name="category" class="form-select">
                        <option value="">Todas</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio mínimo</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="{{ $minPrice }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio máximo</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="{{ $maxPrice }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ordenar por</label>
                    <select name="sort" class="form-select">
                        <option value="newest"     {{ request('sort') == 'newest'     ? 'selected' : '' }}>Más recientes</option>
                        <option value="price_asc"  {{ request('sort') == 'price_asc'  ? 'selected' : '' }}>Precio: menor a mayor</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                        <option value="name_asc"   {{ request('sort') == 'name_asc'   ? 'selected' : '' }}>Nombre A-Z</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('shop.products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Limpiar</a>
            </form>
        </div>
    </div>

    <!-- Productos -->
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Productos <small class="text-muted fs-6">({{ $products->total() }} resultados)</small></h3>
        </div>
        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-6 col-md-4">
                <div class="card border-0 shadow-sm product-card h-100">
                    <div class="card-body text-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="height:150px; width:100%; object-fit:cover; border-radius:8px">
                        @else
                            <i class="bi bi-box fs-1 text-muted"></i>
                        @endif
                        <h6 class="mt-2">{{ $product->name }}</h6>
                        <p class="text-muted small">{{ $product->category?->name }}</p>
                        @if($product->sale_price)
                            <p class="text-muted text-decoration-line-through mb-0">${{ number_format($product->price, 2) }}</p>
                            <p class="fw-bold" style="color:#E95A25">${{ number_format($product->sale_price, 2) }}</p>
                        @else
                            <p class="fw-bold" style="color:#E95A25">${{ number_format($product->price, 2) }}</p>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-0 text-center pb-3">
                        <a href="{{ route('shop.products.show', $product->slug) }}" class="btn btn-primary btn-sm">Ver producto</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1 text-muted"></i>
                    <p class="mt-3 text-muted">No se encontraron productos con esos filtros.</p>
                    <a href="{{ route('shop.products.index') }}" class="btn btn-primary">Ver todos los productos</a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection