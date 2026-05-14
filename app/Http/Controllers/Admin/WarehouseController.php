<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('admin.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('admin.warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Warehouse::create([
            'name'      => $request->name,
            'address'   => $request->address,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.warehouses.index')->with('success', 'Almacén creado correctamente.');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $warehouse->update([
            'name'      => $request->name,
            'address'   => $request->address,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.warehouses.index')->with('success', 'Almacén actualizado correctamente.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('admin.warehouses.index')->with('success', 'Almacén eliminado correctamente.');
    }
}