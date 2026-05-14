<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manijauto Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #1a1a2e;
            width: 250px;
            position: fixed;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 10px 20px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: #E95A25;
            border-radius: 5px;
        }
        .sidebar .brand {
            color: #E95A25;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .navbar-top {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 30px;
            margin-left: 250px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="brand">🚗 Manijauto</div>
        <nav class="nav flex-column px-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link"><i class="bi bi-grid me-2"></i> Categorías</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link"><i class="bi bi-box me-2"></i> Productos</a>
            <a href="{{ route('admin.customers.index') }}" class="nav-link"><i class="bi bi-people me-2"></i> Clientes</a>
            <a href="{{ route('admin.customer-groups.index') }}" class="nav-link"><i class="bi bi-people-fill me-2"></i> Grupos de clientes</a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link"><i class="bi bi-cart me-2"></i> Pedidos</a>
            <a href="{{ route('admin.warehouses.index') }}" class="nav-link"><i class="bi bi-building me-2"></i> Almacenes</a>
            <a href="{{ route('admin.discounts.index') }}" class="nav-link"><i class="bi bi-tag me-2"></i> Descuentos</a>
            <a href="{{ route('admin.inventory.index') }}" class="nav-link"><i class="bi bi-clipboard me-2"></i> Inventario</a>
            <a href="{{ route('admin.reports') }}" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Reportes</a>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
