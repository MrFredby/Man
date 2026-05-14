<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('group')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $groups = CustomerGroup::where('is_active', true)->get();
        return view('admin.customers.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
        ]);

        Customer::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'group_id'  => $request->group_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Cliente creado correctamente.');
    }

    public function edit(Customer $customer)
    {
        $groups = CustomerGroup::where('is_active', true)->get();
        return view('admin.customers.edit', compact('customer', 'groups'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'group_id'  => $request->group_id,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Cliente eliminado correctamente.');
    }
}