<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Admin
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
            return $next($request);
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('user.dashboard');
        } elseif (Auth::user()->role == 'superAdmin') {
            return  redirect()->route('superAdmin');
        }
    }
}
