@extends('shop.layout')

@section('title', 'Productos')

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- Filtros -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1a1a2e">
                        <i class="bi bi-funnel me-2" style="color:#E95A25"></i>Filtrar
                    </h5>
                    <form action="{{ route('shop.products.index') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Nombre del producto">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Categoría</label>
                            <select name="category" class="form-select">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Precio mínimo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">$</span>
                                <input type="number" name="min_price" class="form-control border-start-0" value="{{ request('min_price') }}" placeholder="{{ $minPrice }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Precio máximo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">$</span>
                                <input type="number" name="max_price" class="form-control border-start-0" value="{{ request('max_price') }}" placeholder="{{ $maxPrice }}">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">Ordenar por</label>
                            <select name="sort" class="form-select">
                                <option value="newest"     {{ request('sort') == 'newest'     ? 'selected' : '' }}>Más recientes</option>
                                <option value="price_asc"  {{ request('sort') == 'price_asc'  ? 'selected' : '' }}>Precio: menor a mayor</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                                <option value="name_asc"   {{ request('sort') == 'name_asc'   ? 'selected' : '' }}>Nombre A-Z</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-search me-1"></i> Buscar
                        </button>
                        <a href="{{ route('shop.products.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x me-1"></i> Limpiar filtros
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0" style="color:#1a1a2e">
                    Productos
                    <span class="badge ms-2" style="background-color:#E95A25;font-size:0.8rem">{{ $products->total() }}</span>
                </h4>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-6 col-md-4">
                    <div class="product-card card shadow-sm h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:180px;object-fit:cover">
                        @else
                            <div class="d-flex align-items-center justify-content-center" style="height:180px;background:#f8f9fa">
                                <i class="bi bi-box fs-1 text-muted"></i>
                            </div>
                        @endif
                        @if($product->sale_price)
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-danger">Oferta</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <p class="text-muted small mb-1">{{ $product->category?->name }}</p>
                            <h6 class="fw-bold">{{ $product->name }}</h6>
                            @if($product->sale_price)
                                <span class="text-muted text-decoration-line-through small">${{ number_format($product->price, 2) }}</span>
                                <div class="fw-bold fs-5" style="color:#E95A25">${{ number_format($product->sale_price, 2) }}</div>
                            @else
                                <div class="fw-bold fs-5" style="color:#E95A25">${{ number_format($product->price, 2) }}</div>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="{{ route('shop.products.show', $product->slug) }}" class="btn btn-primary btn-sm w-100">
                                <i class="bi bi-eye me-1"></i> Ver producto
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-search" style="font-size:4rem;color:#dee2e6"></i>
                        <h5 class="mt-3 text-muted">No se encontraron productos</h5>
                        <a href="{{ route('shop.products.index') }}" class="btn btn-primary mt-3">Ver todos</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection