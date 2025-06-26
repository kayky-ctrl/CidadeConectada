<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            abort(response()->json([
                'message' => 'Não autenticado',
                'success' => false
            ], 401));
        }

        return route('login');
    }
}
