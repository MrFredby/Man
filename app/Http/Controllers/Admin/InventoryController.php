<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::with(['product', 'warehouse'])->get();
        return view('admin.inventory.index', compact('inventory'));
    }

    public function create()
    {
        $products   = Product::where('is_active', true)->get();
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('admin.inventory.create', compact('products', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'stock'        => 'required|integer|min:0',
        ]);

        Inventory::updateOrCreate(
            ['product_id' => $request->product_id, 'warehouse_id' => $request->warehouse_id],
            ['stock' => $request->stock]
        );

        return redirect()->route('admin.inventory.index')->with('success', 'Inventario actualizado correctamente.');
    }

    public function edit(Inventory $inventory)
    {
        $products   = Product::where('is_active', true)->get();
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('admin.inventory.edit', compact('inventory', 'products', 'warehouses'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $inventory->update(['stock' => $request->stock]);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventario actualizado correctamente.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('admin.inventory.index')->with('success', 'Registro eliminado correctamente.');
    }
}