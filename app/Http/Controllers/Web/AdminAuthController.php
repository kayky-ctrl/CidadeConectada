<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Debug: verifique os dados do usuário
            Log::info('Login realizado', [
                'user_id' => Auth::id(),
                'is_admin' => Auth::user()->is_admin
            ]);

            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Acesso restrito a administradores']);
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }
}
