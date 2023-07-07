<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Cierra la sesión del usuario autenticado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        // Cerrar la sesión del usuario autenticado
        auth()->logout();

        // Redireccionar al formulario de inicio de sesión
        return redirect()->route('login');
    }
}
