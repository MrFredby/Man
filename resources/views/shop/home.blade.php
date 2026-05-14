@extends('shop.layout')

@section('title', 'Inicio')

@section('content')

<!-- Hero -->
<div class="p-5 mb-4 rounded-3 text-white" style="background-color:#1a1a2e">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Bienvenido a <span style="color:#E95A25">Manijauto</span></h1>
        <p class="col-md-8 fs-4">Las mejores manijas y autopartes al mejor precio.</p>
        <a href="{{ route('shop.products.index') }}" class="btn btn-primary btn-lg">Ver productos</a>
    </div>
</div>

<!-- Categorías -->
@if($categories->count() > 0)
<h3 class="mb-3">Categorías</h3>
<div class="row g-3 mb-5">
    @foreach($categories as $category)
    <div class="col-6 col-md-3">
        <a href="{{ route('shop.products.index', ['category' => $category->id]) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm text-center p-3">
                @if($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="height:80px; width:100%; object-fit:cover; border-radius:8px">
            @else
                <i class="bi bi-grid fs-2" style="color:#E95A25"></i>
            @endif
                <p class="mt-2 mb-0 fw-semibold text-dark">{{ $category->name }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

<!-- Productos destacados -->
<h3 class="mb-3">Productos destacados</h3>
<div class="row g-4">
    @forelse($products as $product)
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm product-card h-100">
            <div class="card-body text-center">
                @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="height:150px; width:100%; object-fit:cover; border-radius:8px">
            @else
                <i class="bi bi-box fs-1 text-muted"></i>
            @endif
                <h6 class="mt-2">{{ $product->name }}</h6>
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
    <p class="text-muted">No hay productos disponibles.</p>
    @endforelse
</div>

@endsection