@extends('shop.layout')

@section('title', $product->name)

@section('content')
<div class="container my-5">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('shop.home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.products.index') }}">Productos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.products.index', ['category' => $product->category_id]) }}">{{ $product->category?->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Imagen -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:400px;object-fit:cover">
                @else
                    <div class="d-flex align-items-center justify-content-center" style="height:400px;background:#f8f9fa">
                        <i class="bi bi-box" style="font-size:8rem;color:#E95A25;opacity:0.3"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info -->
        <div class="col-md-7">
            <p class="text-muted mb-1">{{ $product->category?->name }}</p>
            <h2 class="fw-bold mb-2" style="color:#1a1a2e">{{ $product->name }}</h2>

            @if($product->sku)
                <p class="text-muted small mb-3">SKU: {{ $product->sku }}</p>
            @endif

            <!-- Precio -->
            <div class="mb-4">
                @if($product->sale_price)
                    <span class="text-muted text-decoration-line-through fs-5">${{ number_format($product->price, 2) }}</span>
                    <div class="fw-bold" style="font-size:2.5rem;color:#E95A25;line-height:1">${{ number_format($product->sale_price, 2) }}</div>
                    <span class="badge bg-danger mt-1">
                        {{ round((1 - $product->sale_price / $product->price) * 100) }}% descuento
                    </span>
                @else
                    <div class="fw-bold" style="font-size:2.5rem;color:#E95A25;line-height:1">${{ number_format($product->price, 2) }}</div>
                @endif
            </div>

            <!-- Stock -->
            <div class="mb-4">
                @if($product->stock > 10)
                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>En stock ({{ $product->stock }} disponibles)</span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle me-1"></i>Pocas unidades ({{ $product->stock }} disponibles)</span>
                @else
                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Sin stock</span>
                @endif
            </div>

            <!-- Descripción -->
            @if($product->description)
            <div class="mb-4">
                <h6 class="fw-bold">Descripción</h6>
                <p class="text-muted">{{ $product->description }}</p>
            </div>
            @endif

            <hr>

            <!-- Agregar al carrito -->
            @if($product->stock > 0)
            <form action="{{ route('shop.cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <label class="fw-semibold">Cantidad:</label>
                    <div class="input-group" style="width:130px">
                        <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty()">-</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control text-center">
                        <button type="button" class="btn btn-outline-secondary" onclick="increaseQty({{ $product->stock }})">+</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-cart-plus me-2"></i> Agregar al carrito
                </button>
            </form>
            @else
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>Este producto no tiene stock disponible.
                </div>
            @endif

            <!-- Features -->
            <div class="row g-3 mt-3">
                <div class="col-4 text-center">
                    <i class="bi bi-shield-check fs-4" style="color:#E95A25"></i>
                    <p class="small text-muted mt-1 mb-0">Garantía</p>
                </div>
                <div class="col-4 text-center">
                    <i class="bi bi-truck fs-4" style="color:#E95A25"></i>
                    <p class="small text-muted mt-1 mb-0">Envío rápido</p>
                </div>
                <div class="col-4 text-center">
                    <i class="bi bi-arrow-return-left fs-4" style="color:#E95A25"></i>
                    <p class="small text-muted mt-1 mb-0">Devoluciones</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos relacionados -->
    @if($related->count() > 0)
    <div class="mt-5">
        <h3 class="section-title mb-4">Productos relacionados</h3>
        <div class="row g-4">
            @foreach($related as $item)
            <div class="col-6 col-md-3">
                <div class="product-card card shadow-sm h-100">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="height:150px;object-fit:cover">
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height:150px;background:#f8f9fa">
                            <i class="bi bi-box fs-2 text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $item->name }}</h6>
                        <div class="fw-bold" style="color:#E95A25">${{ number_format($item->sale_price ?? $item->price, 2) }}</div>
                    </div>
                    <div class="card-footer bg-white border-0 pb-3">
                        <a href="{{ route('shop.products.show', $item->slug) }}" class="btn btn-primary btn-sm w-100">Ver producto</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

<script>
    function decreaseQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    }
    function increaseQty(max) {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
    }
</script>
@endsection