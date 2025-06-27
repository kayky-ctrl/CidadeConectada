<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verificação em 2 etapas
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Por favor faça login');
        }

        if (!Auth::user()->is_admin) {
            // Adicione esta linha para debug
            Log::info('Usuário não é admin', ['user_id' => Auth::id(), 'is_admin' => Auth::user()->is_admin]);
            abort(403, 'Você não tem permissão de administrador');
        }

        return $next($request);
    }
}