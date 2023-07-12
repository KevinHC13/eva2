@extends('layouts.dashboard')

@section('titulo')
    Nueva Factura
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
@endpush

@section('contenido')
<div class="p-8 bg-white shadow rounded-lg">
<div class="flex justify-center">
<div class="flex justify-center flex-col w-1/2">
    <label for="files" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sube los archivos</label>
    
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="dropzone border rounded p-1 text-black w-1/2" id="dropzone">
        @csrf
    </form>
</div>
</div>
<div class="flex justify-center">
<form action="{{ route('invoice.update', $invoice) }}" method="POST" class="w-1/2 mt-4 mb-20 " novalidate>
    @csrf
    @method('PUT')
    <div class="relative z-0 w-full mb-6 group">
        <label for="issuing_company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la compañia emisora</label>
        <select name="issuing_company_id" id="issuing_company_id" data-te-select-init data-te-select-filter="true">
            @foreach ($companies as $company)
            <option value="{{ $company->id }}"  @if($invoice->issuing_company_id == $company->id) selected @endif>
                {{ $company->name }}
            </option>
            @endforeach
            
          </select>
        @error('issuing_company_id')
            <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="receiving_company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la compañia receptora</label>
        <select name="receiving_company_id" id="receiving_company_id" data-te-select-init data-te-select-filter="true">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" @if($invoice->receiving_company_id == $company->id) selected @endif>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        
        @error('receiving_company_id')
            <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
        @enderror
    <div class="mb-5">
        <input type="hidden" value="{{ old('id_documents',$invoice->id_documents) }}" name="id_documents" id="id_documents">
        @error('id_documents')
            <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
        @enderror
    </div>
    </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        <a type="submit" href="{{ route('invoice.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
    </form>
</div>
<button
type="hidden"
class="hidden"
data-te-toggle="modal"
data-te-target="#rightTopModal"
data-te-ripple-init
data-te-ripple-color="light"
data-button-modal>
Top right
</button>
</div>

<div
  data-te-modal-init
  class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
  id="rightTopModal"
  tabindex="-1"
  aria-labelledby="rightTopModalLabel"
  aria-hidden="true">
  <div
    data-te-modal-dialog-ref
    class="pointer-events-none absolute right-7 h-auto w-full translate-x-[100%] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
    <div
      class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
      <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <h5
          class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
          id="exampleModalLabel">
          Error
        </h5>
        <!--Close button-->
        <button
          type="button"
          class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
          data-te-modal-dismiss
          aria-label="Close">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!--Modal body-->
      <div class="relative flex-auto p-4" data-te-modal-body-ref>
        Debe subir un archivo .xml y un archivo .pdf
      </div>

      <!--Modal footer-->
      <div
        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <button
          type="button"
          class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
          data-te-modal-dismiss
          data-te-ripple-init
          data-te-ripple-color="light">
          Cerrar
        </button>
    </div>
    </div>
  </div>
</div>

  
@endsection