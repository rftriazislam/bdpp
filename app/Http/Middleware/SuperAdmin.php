<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('nsoft.login');
        } elseif (Auth::user()->role == 'admin') {
            return redirect()->route('admin');
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('user');
        } elseif (Auth::user()->role == 'superAdmin') {
            return $next($request);
        }
    }
}
