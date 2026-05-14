<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manijauto - @yield('title', 'Tienda')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #E95A25;
            --dark: #1a1a2e;
            --dark2: #16213e;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            padding: 12px 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--dark) !important;
        }

        .navbar-brand span {
            color: var(--primary);
        }

        .nav-link {
            font-weight: 500;
            color: #555 !important;
            transition: color 0.2s;
            padding: 8px 15px !important;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 20px;
        }

        .btn-primary:hover {
            background-color: #c94d1f;
            border-color: #c94d1f;
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Cart icon */
        .cart-icon {
            position: relative;
            display: inline-block;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark2) 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(233,90,37,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero h1 span {
            color: var(--primary);
        }

        /* Product cards */
        .product-card {
            border-radius: 12px !important;
            overflow: hidden;
            transition: all 0.3s;
            border: none !important;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
        }

        .product-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .product-card .price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .product-card .old-price {
            text-decoration: line-through;
            color: #aaa;
            font-size: 0.9rem;
        }

        /* Category cards */
        .category-card {
            border-radius: 12px !important;
            overflow: hidden;
            transition: all 0.3s;
            border: none !important;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }

        .category-card .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            padding: 20px 15px 15px;
            color: white;
            font-weight: 600;
        }

        /* Section titles */
        .section-title {
            font-weight: 800;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark2) 100%);
            color: rgba(255,255,255,0.7);
            padding: 50px 0 20px;
        }

        footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 15px;
        }

        footer a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: color 0.2s;
        }

        footer a:hover {
            color: var(--primary);
        }

        footer .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 30px;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(233,90,37,0.15);
        }

        /* Breadcrumb */
        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .navbar-brand { font-size: 1.3rem; }
            .hero { padding: 50px 0; }
            .hero h1 { font-size: 2rem; }
            .product-card .card-body { padding: 10px; }
            .product-card .price { font-size: 1rem; }
            .category-card { height: 100px !important; }
            footer { text-align: center; }
            .table { font-size: 0.85rem; }
            .btn-lg { padding: 10px 20px; font-size: 1rem; }
        }

        @media (max-width: 576px) {
            .hero h1 { font-size: 1.6rem; }
            .hero p { font-size: 1rem; }
            .section-title { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('shop.home') }}">
                🚗 <span>Mani</span>jauto
            </a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
   			<span class="navbar-toggler-icon"></span>
		</button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.home') }}">
                            <i class="bi bi-house me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.products.index') }}">
                            <i class="bi bi-grid me-1"></i> Productos
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.cart.index') }}">
                            <div class="cart-icon">
                                <i class="bi bi-cart3 fs-5"></i>
                                @if(session('cart') && count(session('cart')) > 0)
                                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                                @endif
                            </div>
                        </a>
                    </li>
                    @if(session('customer'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width:32px;height:32px;background-color:var(--primary);font-size:0.8rem">
                                    {{ strtoupper(substr(session('customer.name'), 0, 1)) }}
                                </div>
                                {{ session('customer.name') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px">
                                <li><a class="dropdown-item py-2" href="{{ route('shop.profile') }}"><i class="bi bi-person me-2"></i>Mi perfil</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('shop.orders.index') }}"><i class="bi bi-bag me-2"></i>Mis pedidos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('shop.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop.login') }}">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="{{ route('shop.register') }}">Registrarse</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alertas -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Contenido -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>🚗 Manijauto</h5>
                    <p class="small">Las mejores manijas y autopartes al mejor precio. Calidad garantizada en cada producto.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('shop.home') }}">Inicio</a></li>
                        <li class="mb-2"><a href="{{ route('shop.products.index') }}">Productos</a></li>
                        <li class="mb-2"><a href="{{ route('shop.cart.index') }}">Carrito</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>contacto@manijauto.com</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+52 33 1234 5678</li>
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Guadalajara, Jalisco</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom text-center small">
                <p class="mb-0">© {{ date('Y') }} Manijauto — Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>