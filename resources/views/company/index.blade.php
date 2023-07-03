
@extends('layouts.dashboard')

@section('titulo')
    Empresas
@endsection

@section('contenido')
<div class="flex flex-wrap items-start justify-end -mb-3">
    <a href="{{ route('company.create')}}" class="inline-flex px-5 py-3 text-white bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 rounded-md ml-6 mb-3">
      <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
      Nueva Empresa
    </a>

</div>
<section>
  <div class="flex justify-center m-3 items-center p-8 bg-white shadow rounded-lg">
    <div class="">
      <div class="bg-white w-full shadow-md rounded my-6">
        <table class="text-left border-collapse">
      <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Id</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Razon Social</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">email</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Direccion</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">RFC</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Accion</th>
        </tr>
      </thead>
      <tbody>
        @if ($companies->count())
            @foreach ($companies as $company)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ $company->id }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $company->name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $company->email }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $company->address }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $company->rfc }}</td>
                <td class="py-4 px-6 border-b border-grey-light">
                  <a href="{{ route('company.edit',$company) }}" class="text-sky-600 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Editar</a>
                  <form action="{{ route('company.destroy', $company) }}" method="POST">
                    @method('DELETE')
                    @csrf
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
  </div>
</section>


@endsection