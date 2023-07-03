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
<form action="{{ route('invoice.store') }}" method="POST" class="w-1/2 mt-4 mb-20 " novalidate>
    @csrf
    <div class="relative z-0 w-full mb-6 group">
        <label for="issuing_company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la compañia emisora</label>
        <select name="issuing_company_id" id="issuing_company_id" data-te-select-init data-te-select-filter="true">
            @foreach ($companies as $company)
            <option value="{{ $company->id }}" {{ old('issuing_company_id') == $company->id ? 'selected' : '' }}>
                {{ $company->name }}
            </option>
            @endforeach
            
          </select>
        @error('issuing_company_id')
            <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="receiving_company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la compañia emisora</label>
        <select name="receiving_company_id" id="receiving_company_id" data-te-select-init data-te-select-filter="true">
            @foreach ($companies as $company)
            <option value="{{ $company->id }}" {{ old('receiving_company_id') == $company->id ? 'selected' : '' }}>
                {{ $company->name }}
            </option>
            @endforeach
          </select>
        @error('receiving_company_id')
            <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
        @enderror
    <div class="mb-5">
        <input type="hidden" value="{{ old('id_documents') }}" name="id_documents" id="id_documents">
        @error('id_documents')
            <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
        @enderror
    </div>
    </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        <a type="submit" href="{{ route('company.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
    </form>
</div>
</div>

  
@endsection