<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra la página de inicio del panel de administración.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.index');
    }
}
