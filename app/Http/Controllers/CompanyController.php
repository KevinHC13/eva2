<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

use Dompdf\Options;
use Dompdf\Dompdf;

use Illuminate\Support\Facades\Response;

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

    /**
 * Genera un archivo PDF con los datos de las compañías.
 *
 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
 */
public function generarPDF()
{
    // Obtener los datos del modelo Company
    $companies = Company::all();

    $data = [];

    // Convertir los datos a un arreglo
    foreach($companies as $company){
        $data[] = [$company->rfc, $company->name, $company->email, $company->address];
    }

    // Configurando Dompdf
    $options = new Options();
    $options->setIsHtml5ParserEnabled(true);
    $options->set('isRemoteEnabled', true);

    // Crear instancia de Dompdf
    $dompdf = new Dompdf($options);

    // Contenido HTML del PDF
    $html = '<html><body>';
    $html .= '<table style="border-collapse: collapse; width: 100%;">';
    $html .= '<thead><th style="border: 1px solid #ddd; padding: 8px;">RFC</th><th style="border: 1px solid #ddd; padding: 8px;">Razon Social</th><th style="border: 1px solid #ddd; padding: 8px;">Email</th><th style="border: 1px solid #ddd; padding: 8px;">Direccion</th></thead>';
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $cell) {
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $cell . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
    $html .= '</body></html>';

    // Generar el PDF
    $dompdf->loadHtml($html);
    $dompdf->render();

    // Descargar el PDF
    return $dompdf->stream('companies.pdf');
}

/**
 * Genera un archivo XML con los datos de las compañías.
 *
 * @return \Illuminate\Http\Response
 */
public function generarXML()
{
    // Datos para la tabla
    $companies = Company::all();

    // Construir el contenido XML
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<companies>';

    foreach ($companies as $company) {
        $xml .= '<company>';
        $xml .= '<rfc>' . $company->rfc . '</rfc>';
        $xml .= '<razon_social>' . $company->name . '</razon_social>';
        $xml .= '<email>' . $company->email . '</email>';
        $xml .= '<address>' . $company->address . '</address>';
        $xml .= '</company>';
    }

    $xml .= '</companies>';

    // Generar la respuesta HTTP con el contenido XML
    return Response::make($xml, 200, [
        'Content-Type' => 'text/xml',
        'Content-Disposition' => 'attachment; filename="companies.xml"',
    ]);
}
}
