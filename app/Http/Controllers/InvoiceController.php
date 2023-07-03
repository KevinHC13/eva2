<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10);

        return view('invoice.index',[
            'invoices' => $invoices
        ]);
    }

    public function create()
    {
        $companies = Company::all();
        return view('invoice.create',[
            'companies' => $companies,
        ]);
    }

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
}
