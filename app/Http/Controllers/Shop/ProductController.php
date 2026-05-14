<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $query      = Product::where('is_active', true);
        $categories = Category::where('is_active', true)->get();

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }

        if (request('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        if (request('sort')) {
            switch (request('sort')) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $minPrice = Product::where('is_active', true)->min('price');
        $maxPrice = Product::where('is_active', true)->max('price');

        $products = $query->paginate(12);
        return view('shop.products.index', compact('products', 'categories', 'minPrice', 'maxPrice'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->where('is_active', true)
                          ->take(4)->get();
        return view('shop.products.show', compact('product', 'related'));
    }
}