
@extends('layouts.dashboard')

@push('js')
  <script src="https://kit.fontawesome.com/e56805774d.js" crossorigin="anonymous"></script>    
@endpush


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
    <a href="{{ route('company.pdf')}}" class="inline-flex px-5 py-3 text-white bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 rounded-md ml-6 mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="-ml-1 mr-2" ><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H176c-35.3 0-64 28.7-64 64V512H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"/></svg>
      Descargar PDF
    </a>
    <a href="{{ route('company.xml')}}" class="inline-flex px-5 py-3 text-white bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 rounded-md ml-6 mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="-ml-1 mr-2"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z"/></svg>
      Descargar XML
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

{{ $companies->links() }}

@endsection