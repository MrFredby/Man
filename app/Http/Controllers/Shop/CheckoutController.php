<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $subtotal       = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $discount       = session()->get('discount', null);
        $discountAmount = 0;

        if ($discount) {
            if ($discount['type'] == 'percent') {
                $discountAmount = $subtotal * ($discount['value'] / 100);
            } else {
                $discountAmount = min($discount['value'], $subtotal);
            }
        }

        $subtotalAfterDiscount = max(0, $subtotal - $discountAmount);
        $tax   = $subtotalAfterDiscount * 0.16;
        $total = $subtotalAfterDiscount + $tax;

        return view('shop.checkout.index', compact('cart', 'subtotal', 'discount', 'discountAmount', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $subtotal       = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $discount       = session()->get('discount', null);
        $discountAmount = 0;

        if ($discount) {
            if ($discount['type'] == 'percent') {
                $discountAmount = $subtotal * ($discount['value'] / 100);
            } else {
                $discountAmount = min($discount['value'], $subtotal);
            }
        }

        $subtotalAfterDiscount = max(0, $subtotal - $discountAmount);
        $tax   = $subtotalAfterDiscount * 0.16;
        $total = $subtotalAfterDiscount + $tax;

        $order = Order::create([
            'customer_id'      => session('customer.id'),
            'status'           => 'pending',
            'subtotal'         => $subtotal,
            'tax'              => $tax,
            'total'            => $total,
            'shipping_address' => $request->shipping_address,
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        session()->forget('discount');

        return redirect()->route('shop.orders.index')->with('success', '¡Pedido realizado correctamente!');
    }
}