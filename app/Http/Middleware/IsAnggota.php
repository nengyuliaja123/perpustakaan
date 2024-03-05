<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAnggota
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // jika tidak ter autentikasi atau akses level user tidak sama dengan anggota
        if (!auth()->check() || auth()->user()->access_level != 'anggota') {
            abort(403);
        }
        return $next($request);
    }
}
