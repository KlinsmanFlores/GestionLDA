<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                switch ($user->id_rol) {
                    case 1:
                        return redirect('/admin/inicio');
                    case 2:
                        return redirect('/cliente/inicio');
                    case 3:
                        return redirect('/chofer/inicio');
                    case 4:
                        return redirect('/vendedor/inicio');
                    case 5:
                        return redirect('/logistica/inicio');
                    default:
                        return redirect('/dashboard');
                }
            }
        }

        return $next($request);
    }
}
