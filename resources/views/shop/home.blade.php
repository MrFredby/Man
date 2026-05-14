@extends('shop.layout')

@section('title', 'Inicio')

@section('content')

<!-- Hero -->
<div class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1>Las mejores <span>autopartes</span> al mejor precio</h1>
                <p class="mt-3 mb-4 fs-5" style="color:rgba(255,255,255,0.7)">
                    Encuentra manijas, frenos, baterías y más. Envío rápido y garantía en todos nuestros productos.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('shop.products.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-grid me-2"></i>Ver productos
                    </a>
                    @if(!session('customer'))
                        <a href="{{ route('shop.register') }}" class="btn btn-outline-light btn-lg">
                            Registrarse gratis
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-5 text-center d-none d-md-block">
                <i class="bi bi-car-front" style="font-size:12rem; color:rgba(233,90,37,0.3)"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="bg-white py-4 shadow-sm">
    <div class="container">
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold mb-1" style="color:#E95A25">+500</h3>
                    <p class="text-muted small mb-0">Productos</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold mb-1" style="color:#E95A25">+1000</h3>
                    <p class="text-muted small mb-0">Clientes</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold mb-1" style="color:#E95A25">24/7</h3>
                    <p class="text-muted small mb-0">Soporte</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold mb-1" style="color:#E95A25">100%</h3>
                    <p class="text-muted small mb-0">Garantía</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">

    <!-- Categorías -->
    @if($categories->count() > 0)
    <h2 class="section-title mb-4">Categorías</h2>
    <div class="row g-3 mb-5">
        @foreach($categories as $category)
        <div class="col-6 col-md-3">
            <a href="{{ route('shop.products.index', ['category' => $category->id]) }}" class="text-decoration-none">
                <div class="category-card card shadow-sm position-relative" style="height:130px">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width:100%;height:100%;object-fit:cover">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100" style="background:linear-gradient(135deg,#1a1a2e,#16213e)">
                            <i class="bi bi-grid fs-1" style="color:rgba(233,90,37,0.6)"></i>
                        </div>
                    @endif
                    <div class="overlay">{{ $category->name }}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Productos destacados -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">Productos destacados</h2>
        <a href="{{ route('shop.products.index') }}" class="btn btn-outline-primary btn-sm">Ver todos</a>
    </div>
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-6 col-md-3">
            <div class="product-card card shadow-sm h-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:180px;object-fit:cover">
                @else
                    <div class="d-flex align-items-center justify-content-center" style="height:180px;background:#f8f9fa">
                        <i class="bi bi-box fs-1 text-muted"></i>
                    </div>
                @endif
                <div class="card-body">
                    <p class="text-muted small mb-1">{{ $product->category?->name }}</p>
                    <h6 class="fw-bold">{{ $product->name }}</h6>
                    @if($product->sale_price)
                        <span class="old-price">${{ number_format($product->price, 2) }}</span>
                        <div class="price">${{ number_format($product->sale_price, 2) }}</div>
                    @else
                        <div class="price">${{ number_format($product->price, 2) }}</div>
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
        <p class="text-muted">No hay productos disponibles.</p>
        @endforelse
    </div>
</div>

<!-- Banner -->
<div class="py-5 my-3" style="background:linear-gradient(135deg,#1a1a2e,#16213e)">
    <div class="container text-center text-white">
        <h3 class="fw-bold mb-3">¿Eres distribuidor o mayorista?</h3>
        <p class="mb-4" style="color:rgba(255,255,255,0.7)">Contáctanos para obtener precios especiales y descuentos exclusivos para tu negocio.</p>
        <a href="{{ route('shop.register') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-person-plus me-2"></i>Crear cuenta
        </a>
    </div>
</div>

@endsection