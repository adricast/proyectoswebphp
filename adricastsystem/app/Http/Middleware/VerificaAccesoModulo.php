<?php
<<<<<<< HEAD

=======
>>>>>>> 7327fdf (07-06-2025 Roles Middleware y Rutas)
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificaAccesoModulo
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $tipoUsuario = $user->typeUser;

        if (!$tipoUsuario) {
            return redirect()->route('posts.index');
        }

        // Lista de rutas exentas de validación
        $rutasExentas = ['home', 'reikomodulos', 'inicio'];

        $rutaActual = trim($request->path(), '/'); // ejemplo: 'usuarios/create'

        // Validar rutas exentas (como prefijos)
        foreach ($rutasExentas as $ruta) {
            $ruta = trim($ruta, '/');
            if ($rutaActual === $ruta || str_starts_with($rutaActual, $ruta . '/')) {
                return $next($request);
            }
        }

        // Rutas permitidas por los módulos del usuario
        $modulosPermitidos = $tipoUsuario->roles()
            ->where('estado', 1)
            ->with('modulo')
            ->get()
            ->pluck('modulo')
            ->filter()
            ->pluck('ruta')
            ->map(fn($ruta) => trim($ruta, '/')) // elimina '/' inicial y final
            ->toArray();

        // Validar si la ruta actual comienza con alguna ruta permitida o es igual
        foreach ($modulosPermitidos as $rutaPermitida) {
            if ($rutaActual === $rutaPermitida || str_starts_with($rutaActual, $rutaPermitida . '/')) {
                return $next($request);
            }
        }

        abort(403, 'No tienes autorización para acceder a esta página.');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 7327fdf (07-06-2025 Roles Middleware y Rutas)
