<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manijauto Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #E95A25;
            --dark: #1a1a2e;
            --dark2: #16213e;
            --dark3: #0f3460;
        }

        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--dark) 0%, var(--dark2) 100%);
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
        }

        .sidebar .brand {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .brand h4 {
            color: #fff;
            font-weight: 700;
            margin: 0;
        }

        .sidebar .brand span {
            color: var(--primary);
        }

        .sidebar .brand small {
            color: rgba(255,255,255,0.4);
            font-size: 0.75rem;
        }

        .sidebar .nav-section {
            padding: 15px 20px 5px;
            color: rgba(255,255,255,0.3);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.6);
            padding: 10px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(233,90,37,0.2);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--primary);
            box-shadow: 0 4px 15px rgba(233,90,37,0.4);
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Top navbar */
        .top-navbar {
            margin-left: 260px;
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .top-navbar .page-title {
            font-weight: 600;
            color: var(--dark);
            font-size: 1.1rem;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        /* Cards */
        .card {
            border-radius: 12px !important;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        /* Tables */
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr:hover {
            background-color: #fff8f5;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #c94d1f !important;
            border-color: #c94d1f !important;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Form controls */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(233,90,37,0.15);
        }

        /* Badges */
        .badge {
            border-radius: 6px;
            padding: 5px 10px;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="brand">
            <h4>🚗 <span>Mani</span>jauto</h4>
            <small>Panel de Administración</small>
        </div>

        <nav class="nav flex-column mt-2 flex-grow-1">
            <div class="nav-section">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                <i class="bi bi-bar-chart me-2"></i> Reportes
            </a>

            <div class="nav-section mt-2">Catálogo</div>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="bi bi-grid me-2"></i> Categorías
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <i class="bi bi-box me-2"></i> Productos
            </a>
            <a href="{{ route('admin.inventory.index') }}" class="nav-link {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check me-2"></i> Inventario
            </a>

            <div class="nav-section mt-2">Ventas</div>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="bi bi-cart me-2"></i> Pedidos
            </a>
            <a href="{{ route('admin.discounts.index') }}" class="nav-link {{ request()->routeIs('admin.discounts*') ? 'active' : '' }}">
                <i class="bi bi-tag me-2"></i> Descuentos
            </a>

            <div class="nav-section mt-2">Clientes</div>
            <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Clientes
            </a>
            <a href="{{ route('admin.customer-groups.index') }}" class="nav-link {{ request()->routeIs('admin.customer-groups*') ? 'active' : '' }}">
                <i class="bi bi-people-fill me-2"></i> Grupos
            </a>

            <div class="nav-section mt-2">Logística</div>
            <a href="{{ route('admin.warehouses.index') }}" class="nav-link {{ request()->routeIs('admin.warehouses*') ? 'active' : '' }}">
                <i class="bi bi-building me-2"></i> Almacenes
            </a>
        </nav>

        <div class="p-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
            <a href="{{ route('shop.home') }}" target="_blank" class="nav-link text-center">
                <i class="bi bi-shop me-2"></i> Ver tienda
            </a>
        </div>
    </div>

    <!-- Top Navbar -->
    <div class="top-navbar">
        <span class="page-title">@yield('page-title', 'Panel de Administración')</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">{{ now()->format('d/m/Y') }}</span>
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width:35px;height:35px;background-color:#E95A25">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>