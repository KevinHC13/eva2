<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Almacena un nuevo usuario registrado.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Agrega el nombre de usuario al request, utilizando un slug del nombre proporcionado
        $request->request->add(['username' => Str::slug($request->username)]);

        // Valida los datos de entrada
        $this->validate($request, [
            'name' => 'required|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        // Crea un nuevo usuario en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autentica al usuario recién registrado
        auth()->attempt($request->only('email','password'));

        // Redirecciona al muro del usuario
        return redirect()->route('posts.index', $request->username);
    }
}
