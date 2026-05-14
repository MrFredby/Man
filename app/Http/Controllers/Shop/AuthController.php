<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('shop.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::with('group')
                            ->where('email', $request->email)
                            ->where('is_active', true)
                            ->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return back()->with('error', 'Credenciales incorrectas.');
        }

        session()->put('customer', [
            'id'               => $customer->id,
            'name'             => $customer->name,
            'email'            => $customer->email,
            'group_id'         => $customer->group_id,
            'group_name'       => $customer->group?->name,
            'discount_percent' => $customer->group?->discount_percent ?? 0,
        ]);

        // Aplicar descuento del grupo automáticamente
        if ($customer->group && $customer->group->discount_percent > 0) {
            session()->put('discount', [
                'code'  => 'GRUPO: ' . $customer->group->name,
                'type'  => 'percent',
                'value' => $customer->group->discount_percent,
            ]);
        }

        return redirect()->route('shop.home')->with('success', 'Bienvenido, ' . $customer->name);
    }

    public function registerForm()
    {
        return view('shop.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'is_active' => true,
        ]);

        session()->put('customer', [
            'id'               => $customer->id,
            'name'             => $customer->name,
            'email'            => $customer->email,
            'group_id'         => null,
            'group_name'       => null,
            'discount_percent' => 0,
        ]);

        return redirect()->route('shop.home')->with('success', 'Cuenta creada correctamente. Bienvenido, ' . $customer->name);
    }

    public function logout()
    {
        session()->forget('customer');
        session()->forget('discount');
        return redirect()->route('shop.home')->with('success', 'Sesión cerrada correctamente.');
    }
}