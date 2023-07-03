<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // Si las credenciales son incorrectas, redireccionar de vuelta con un mensaje de error
            return back()->with('mensaje', 'Credenciales incorrectas');
        }
        
        return redirect()->route('invoice.index');
    }
}
