<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $customer = Customer::findOrFail(session('customer.id'));
        return view('shop.profile', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Customer::findOrFail(session('customer.id'));

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        session()->put('customer.name', $request->name);
        session()->put('customer.email', $request->email);

        return redirect()->route('shop.profile')->with('success', 'Perfil actualizado correctamente.');
    }
}