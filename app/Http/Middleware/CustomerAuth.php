<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('customer')) {
            return redirect()->route('shop.login')->with('error', 'Debes iniciar sesión para continuar.');
        }
        return $next($request);
    }
}