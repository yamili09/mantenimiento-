<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Busca 'login.blade.php' directamente suelto en views
    public function showLogin() {
        return view('login'); 
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirección limpia forzada hacia el Dashboard
            return redirect()->route('home');
        }

        // Si falla el login, regresa con el error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Modificado para que al salir te mande directo a la ruta del login
    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Te redirige usando el nombre de la ruta asignado en web.php
        return redirect()->route('login');
    }
}