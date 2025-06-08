<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticatePages
{
    public function handle($request, Closure $next)
    {
        $openRoutes = ['landing', 'login', 'login.post'];

        if (!Auth::check() && !$request->routeIs($openRoutes)) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
