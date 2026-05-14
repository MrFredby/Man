<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('customerGroup')->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $groups = CustomerGroup::where('is_active', true)->get();
        return view('admin.discounts.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'  => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
        ]);

        Discount::create([
            'code'              => $request->code,
            'type'              => $request->type,
            'value'             => $request->value,
            'customer_group_id' => $request->customer_group_id,
            'min_quantity'      => $request->min_quantity,
            'starts_at'         => $request->starts_at,
            'expires_at'        => $request->expires_at,
            'is_active'         => $request->has('is_active'),
        ]);

        return redirect()->route('admin.discounts.index')->with('success', 'Descuento creado correctamente.');
    }

    public function edit(Discount $discount)
    {
        $groups = CustomerGroup::where('is_active', true)->get();
        return view('admin.discounts.edit', compact('discount', 'groups'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'type'  => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
        ]);

        $discount->update([
            'code'              => $request->code,
            'type'              => $request->type,
            'value'             => $request->value,
            'customer_group_id' => $request->customer_group_id,
            'min_quantity'      => $request->min_quantity,
            'starts_at'         => $request->starts_at,
            'expires_at'        => $request->expires_at,
            'is_active'         => $request->has('is_active'),
        ]);

        return redirect()->route('admin.discounts.index')->with('success', 'Descuento actualizado correctamente.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Descuento eliminado correctamente.');
    }
}