<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'issuing_company_rfc' => 'required',
            'receiving_company_rfc' => 'required'
        ]);
        

        $issuing_company = Company::where('rfc', $request->issuing_company_rfc)->get();
        $receiving_company = Company::where('rfc', $request->receiving_company_rfc)->get();
        if(is_null($request->folio ) && is_null($request->created_at)){
            $invoices = Invoice::where('issuing_company_id',$issuing_company[0]->id)
                    ->where('receiving_company_id',$receiving_company[0]->id)
                    ->paginate(10);
        }

        if(is_null($request->created_at) && !is_null($request->folio)){
            $invoices = Invoice::where('issuing_company_id',$issuing_company[0]->id)
                    ->where('receiving_company_id',$receiving_company[0]->id)
                    ->where('folio',$request->folio)
                    ->paginate(10);
        }
        
        if(!is_null($request->created_at) && is_null($request->folio)){
            $invoices = Invoice::where('issuing_company_id',$issuing_company[0]->id)
                    ->where('receiving_company_id',$receiving_company[0]->id)
                    ->whereDate('created_at','=',$request->created_at)
                    ->paginate(10);
        }


        return view('client.list',[
            'invoices' => $invoices
        ]);
    }
}
