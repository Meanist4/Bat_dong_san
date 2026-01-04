<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard()->check()) {
            return redirect()->route('login');
        }
        if (auth()->guard()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
