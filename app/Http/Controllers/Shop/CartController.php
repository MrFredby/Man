<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $cart     = session()->get('cart', []);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $discount = session()->get('discount', null);
        $discountAmount = 0;

        if ($discount) {
            if ($discount['type'] == 'percent') {
                $discountAmount = $subtotal * ($discount['value'] / 100);
            } else {
                $discountAmount = min($discount['value'], $subtotal);
            }
        }

        $total = max(0, $subtotal - $discountAmount);
        return view('shop.cart.index', compact('cart', 'subtotal', 'total', 'discount', 'discountAmount'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart    = session()->get('cart', []);
        $id      = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->sale_price ?? $product->price,
                'quantity' => $request->quantity ?? 1,
                'slug'     => $product->slug,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);
        return redirect()->route('shop.cart.index')->with('success', 'Carrito actualizado.');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);
        return redirect()->route('shop.cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Discount::where('code', $request->code)
                          ->where('is_active', true)
                          ->first();

        if (!$coupon) {
            return redirect()->route('shop.cart.index')->with('error', 'Cupón no válido.');
        }

        if ($coupon->expires_at && Carbon::parse($coupon->expires_at)->isPast()) {
            return redirect()->route('shop.cart.index')->with('error', 'Este cupón ha expirado.');
        }

        if ($coupon->starts_at && Carbon::parse($coupon->starts_at)->isFuture()) {
            return redirect()->route('shop.cart.index')->with('error', 'Este cupón aún no está vigente.');
        }

        session()->put('discount', [
            'code'  => $coupon->code,
            'type'  => $coupon->type,
            'value' => (float) $coupon->value,
        ]);

        return redirect()->route('shop.cart.index')->with('success', '¡Cupón aplicado correctamente!');
    }

    public function removeCoupon()
    {
        session()->forget('discount');
        return redirect()->route('shop.cart.index')->with('success', 'Cupón eliminado.');
    }
}