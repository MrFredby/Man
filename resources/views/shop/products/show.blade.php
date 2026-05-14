@extends('shop.layout')

@section('title', $product->name)

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('shop.home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('shop.products.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-5 text-center">
        <div class="card border-0 shadow-sm p-5">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%; max-height:400px; object-fit:cover; border-radius:8px">
            @else
                <i class="bi bi-box" style="font-size: 8rem; color:#E95A25"></i>
            @endif
        </div>
    </div>
    <div class="col-md-7">
        <h2>{{ $product->name }}</h2>
        <p class="text-muted">Categoría: {{ $product->category?->name }}</p>
        <p class="text-muted">SKU: {{ $product->sku ?? '—' }}</p>
        <hr>
        @if($product->sale_price)
            <p class="text-muted text-decoration-line-through fs-5">${{ number_format($product->price, 2) }}</p>
            <h3 style="color:#E95A25">${{ number_format($product->sale_price, 2) }}</h3>
        @else
            <h3 style="color:#E95A25">${{ number_format($product->price, 2) }}</h3>
        @endif

        <p class="text-muted">Stock disponible: {{ $product->stock }}</p>
        <p>{{ $product->description }}</p>
        <hr>

        @if($product->stock > 0)
        <form action="{{ route('shop.cart.add') }}" method="POST" class="d-flex align-items-center gap-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width:80px">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-cart-plus me-1"></i> Agregar al carrito
            </button>
        </form>
        @else
            <div class="alert alert-warning">Producto sin stock disponible.</div>
        @endif
    </div>
</div>

@if($related->count() > 0)
<hr class="my-5">
<h4>Productos relacionados</h4>
<div class="row g-4">
    @foreach($related as $item)
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm product-card h-100">
            <div class="card-body text-center">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="height:150px; width:100%; object-fit:cover; border-radius:8px">
                @else
                    <i class="bi bi-box fs-1 text-muted"></i>
                @endif  
                <h6 class="mt-2">{{ $item->name }}</h6>
                <p class="fw-bold" style="color:#E95A25">${{ number_format($item->price, 2) }}</p>
            </div>
            <div class="card-footer bg-white border-0 text-center pb-3">
                <a href="{{ route('shop.products.show', $item->slug) }}" class="btn btn-primary btn-sm">Ver</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection