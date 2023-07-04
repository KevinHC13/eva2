
@extends('layouts.dashboard')

@section('titulo')
    Facturas
@endsection

@section('contenido')
<div class="flex flex-wrap items-start justify-end -mb-3">
    <a href="{{ route('invoice.create') }}" class="inline-flex px-5 py-3 text-white bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 rounded-md ml-6 mb-3">
      <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
      Nueva Factura
    </a>
  </div>


  <div class="flex justify-center m-3 items-center p-8 bg-white shadow rounded-lg">
      <div class="bg-white  shadow-md rounded my-6">
        <table class="text-left border-collapse">
      <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Folio</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Empresa Emisora</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Empresa Receptora</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Descargar archivos</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
        </tr>
      </thead>
      <tbody>
        
          @if ($invoices->count())
              @foreach ($invoices as $invoice)
                <tr class="hover:bg-grey-lighter">        
                  <td class="py-4 px-6 border-b border-grey-light">{{ $invoice->folio }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $invoice->issuingCompany->name }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $invoice->receivingCompany->name }}</td>
                  <td class="py-4 px-6 border-b border-grey-light text-center">
                    <a href="{{ route('invoice.download',$invoice->id_documents . '.xml') }}" class="text-grey-lighter  font-bold py-1 px-3 rounded border bg-sky-200 hover:bg-sky-300 transition-all text-xs bg-green hover:bg-green-dark">XML</a>
                    <a href="{{ route('invoice.download',$invoice->id_documents . '.pdf') }}" class="text-grey-lighter font-bold py-1 px-3 rounded border bg-sky-200 hover:bg-sky-300 transition-all text-xs bg-blue hover:bg-blue-dark">PDF</a>
                  </td>
                  <td class="py-4 px-6 border-b border-grey-light">
                    <a href="{{ route('invoice.edit', $invoice) }}" class="text-sky-600 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Editar</a>
                    <form action="{{ route('invoice.destroy', $invoice) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input 
                        type="submit" 
                        value="Eliminar"
                        class="text-red-600 font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark  cursor-pointer"
                        >
                    </form>
                  </td>
                </tr>
                @endforeach
          @else
              
          @endif
      </tbody>
    </table>
  </div>
</div>

{{$invoices->links()}}

@endsection