<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
    public function index()
    {
        $groups = CustomerGroup::withCount('customers')->get();
        return view('admin.customer-groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.customer-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        CustomerGroup::create([
            'name'             => $request->name,
            'description'      => $request->description,
            'discount_percent' => $request->discount_percent,
            'is_active'        => $request->has('is_active'),
        ]);

        return redirect()->route('admin.customer-groups.index')->with('success', 'Grupo creado correctamente.');
    }

    public function edit(CustomerGroup $customerGroup)
    {
        return view('admin.customer-groups.edit', compact('customerGroup'));
    }

    public function update(Request $request, CustomerGroup $customerGroup)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        $customerGroup->update([
            'name'             => $request->name,
            'description'      => $request->description,
            'discount_percent' => $request->discount_percent,
            'is_active'        => $request->has('is_active'),
        ]);

        return redirect()->route('admin.customer-groups.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->delete();
        return redirect()->route('admin.customer-groups.index')->with('success', 'Grupo eliminado correctamente.');
    }
}