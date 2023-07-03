
@extends('layouts.dashboard')

@section('titulo')
    Facturas
@endsection

@section('contenido')
<div class="flex flex-wrap items-start justify-end -mb-3">
    <button class="inline-flex px-5 py-3 text-white bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 rounded-md ml-6 mb-3">
      <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
      Nueva Factura
    </button>
  </div>
</div>
<section>
  <div class="flex justify-center items-center p-8 bg-white shadow rounded-lg">
    <div class="">
      <div class="bg-white w-full shadow-md rounded my-6">
        <table class="text-left border-collapse">
      <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Folio</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Empresa Emisora</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Empresa Receptora</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Archivos</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-grey-lighter">
          <td class="py-4 px-6 border-b border-grey-light">New York</td>
          <td class="py-4 px-6 border-b border-grey-light">New York</td>
          <td class="py-4 px-6 border-b border-grey-light">New York</td>
          <td class="py-4 px-6 border-b border-grey-light">New York</td>
          <td class="py-4 px-6 border-b border-grey-light">
            <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>
            <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark">View</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
  </div>
</section>


@endsection