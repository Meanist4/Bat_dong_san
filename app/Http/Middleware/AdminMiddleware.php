<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        
        //Check admin
        if (auth()->guard()->check() && auth()->guard()->user()->is_admin) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Bạn Không Có Quyền Truy Cập Trang Này');
    }
}
