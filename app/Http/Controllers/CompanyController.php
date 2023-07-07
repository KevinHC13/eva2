<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Crea una nueva instancia del controlador.
     * Aplica el middleware 'auth' a todos los métodos excepto 'show' e 'index'.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    
    /**
     * Muestra una lista paginada de empresas.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('company.index', [
            'companies' => $companies
        ]);
    }

    /**
     * Muestra el formulario de creación de una empresa.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Almacena una nueva empresa creada a partir de los datos del formulario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:60|email',
            'address' => 'required|max:255',
            'rfc' => 'required|max:13|min:12|unique:companies'
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'rfc' => $request->rfc
        ]);

        return redirect()->route('company.index');
    }

    /**
     * Elimina la empresa especificada.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return redirect()->route('company.index');
    }

    /**
     * Muestra el formulario de edición para la empresa especificada.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Company $company)
    {
        return view('company.edit', [
            'company' => $company,
        ]);
    }

    /**
     * Actualiza la empresa especificada con los datos del formulario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:60|email',
            'address' => 'required|max:255',
            'rfc' => 'required|max:13|min:12'
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->rfc = $request->rfc;

        $company->save();

        return redirect()->route('company.index');
    }
}
