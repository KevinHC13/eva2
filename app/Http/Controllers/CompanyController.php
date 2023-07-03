<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);

        return view('company.index', [
            'companies' => $companies
        ]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
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

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return redirect()->route('company.index');
    }

    public function edit(Company $company)
    {
        return view('company.edit',[
            'company' => $company,
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:60||email',
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
