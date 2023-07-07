<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Crea una nueva instancia del controlador.
     * Aplica el middleware 'auth' a todos los métodos.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Muestra una lista paginada de facturas.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);

        return view('invoice.index', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Muestra el formulario de creación de una nueva factura.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $companies = Company::all();
        return view('invoice.create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Almacena una nueva factura creada a partir de los datos del formulario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'issuing_company_id' => 'required',
            'receiving_company_id' => 'required',
            'id_documents' => 'required',
        ]);

        Invoice::create([
            'issuing_company_id' => $request->issuing_company_id,
            'receiving_company_id' => $request->receiving_company_id,
            'id_documents' => $request->id_documents,
            'folio' => Str::random(10)
        ]);

        return redirect()->route('invoice.index');
    }

    /**
     * Descarga el archivo especificado.
     *
     * @param  string  $filename
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($filename)
    {
        $path = public_path('uploads/' . $filename);
        
        // Verificar si el archivo existe en la carpeta public/uploads
        if (file_exists($path)) {
            // Descargar el archivo con una respuesta HTTP
            return response()->download($path);
        }

        // Si el archivo no existe, puedes retornar una respuesta con un código de error o redireccionar a otra página
        return response()->json(['error' => 'El archivo no existe'], 404);
    }

    /**
     * Elimina la factura especificada.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        $extensions = ['.xml', '.pdf'];

        foreach ($extensions as $index => $extension) {
            $file_path = public_path('uploads/' . $invoice->id_documents . $extension); 
            if (File::exists($file_path)) {
                unlink($file_path);
            }
        }

        return redirect()->route('invoice.index');
    }

    /**
     * Muestra el formulario de edición para la factura especificada.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Invoice $invoice)
    {
        $companies = Company::all();
        return view('invoice.edit', [
            'invoice' => $invoice,
            'companies' => $companies
        ]);
    }

    /**
     * Actualiza la factura especificada con los datos del formulario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'issuing_company_id' => 'required',
            'receiving_company_id' => 'required',
            'id_documents' => 'required',
        ]);

        $invoice->issuing_company_id = $request->issuing_company_id;
        $invoice->receiving_company_id = $request->receiving_company_id;
        $invoice->id_documents = $request->id_documents;
        
        $invoice->save();

        return redirect()->route('invoice.index');
    }
}
