<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Procesa los datos de inicio de sesión.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        // Si las credenciales son correctas, redireccionar a la ruta "invoice.index"
        return redirect()->route('invoice.index');
    }
}
