<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->rol == "administrador") { 
                return $next($request);
            } else {
                return response()->json(['message' => 'Forbidden: No tienes permiso de técnico.'], 403);
            }
        } else {
            return response()->json(['message' => 'Unauthorized: No estas autenticado.'], 401);
        }
    }




}
