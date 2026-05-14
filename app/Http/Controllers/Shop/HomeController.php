<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products   = Product::where('is_active', true)->latest()->take(8)->get();
        $categories = Category::where('is_active', true)->get();
        return view('shop.home', compact('products', 'categories'));
    }
}