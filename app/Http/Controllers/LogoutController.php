<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        // Cerrar la sesión del usuario autenticado
        auth()->logout();

        // Redireccionar al formulario de inicio de sesión
        return redirect()->route('login');
    }
}
