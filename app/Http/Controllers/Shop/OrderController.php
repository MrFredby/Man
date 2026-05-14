<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', session('customer.id'))
                       ->latest()
                       ->get();
        return view('shop.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== session('customer.id')) {
            abort(403);
        }
        $order->load('items.product');
        return view('shop.orders.show', compact('order'));
    }
}