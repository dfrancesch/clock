<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in')) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Debe iniciar sesión para acceder al administrador.');
        }

        return $next($request);
    }
}

