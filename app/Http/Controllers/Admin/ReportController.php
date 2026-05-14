<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Ventas totales
        $totalSales    = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders   = Order::count();
        $totalCustomers = Customer::count();
        $totalProducts  = Product::count();

        // Pedidos por estado
        $ordersByStatus = Order::selectRaw('status, count(*) as total')
                               ->groupBy('status')
                               ->get();

        // Ventas por mes (últimos 6 meses)
        $salesByMonth = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                             ->where('status', '!=', 'cancelled')
                             ->where('created_at', '>=', now()->subMonths(6))
                             ->groupBy('month')
                             ->orderBy('month')
                             ->get();

        // Productos más vendidos
        $topProducts = OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
                                ->with('product')
                                ->groupBy('product_id')
                                ->orderByDesc('total_sold')
                                ->take(5)
                                ->get();

        // Últimos 5 pedidos
        $latestOrders = Order::with('customer')->latest()->take(5)->get();

        return view('admin.reports.index', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'ordersByStatus',
            'salesByMonth',
            'topProducts',
            'latestOrders'
        ));
    }
}