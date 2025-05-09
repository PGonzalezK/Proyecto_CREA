<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Admin: acceso total
        if ($user->id_empresa == 0) {
            return $next($request);
        }

        $uri = $request->path();

        // Verifica acceso por empresa
        if (str_starts_with($uri, 'crea') && $user->id_empresa != 1) {
            return response()->view('errors.custom', [
                'mensaje' => 'No tienes acceso al portal CREA',
                'empresa' => $user->id_empresa
            ], 403);
        }

        if (str_starts_with($uri, 'edifica') && $user->id_empresa != 2) {
            return response()->view('errors.custom', [
                'mensaje' => 'No tienes acceso al portal EDIFICA',
                'empresa' => $user->id_empresa
            ], 403);
        }

        return $next($request);
    }
}
