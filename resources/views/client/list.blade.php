@extends('layouts.app')

@section('contenido')
<div class="bg-white">
  <header class="absolute inset-x-0 top-0 z-10">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="{{ route('client.index') }}"  class="w-8 -mt-3">
          <span class="sr-only">Home</span>
          <img src="{{asset('images/Logo.svg')}}" alt="">
        </a>
      </div>

      @auth
      <div class="flex">
        <a href="{{ route('invoice.index') }}"  class="w-8 -mt-3">
          <span class="sr-only">Home</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
          </svg>
          
        </a>
      </div>
      @endauth

      
      
    </nav>
  </header>

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div style="pointer-events: none;" class="absolute inset-x-0 -top-40 z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    </div>

</div>
<h1 class="text-gray-900 text-4xl font-bold m-4 ">Facturas</h1>
<div class="m-3 p-8 bg-white shadow rounded-lg " >
<div class="flex justify-center">
  <div class="bg-white shadow-md rounded my-6">
    <table class="text-left border-collapse">
  <thead>
    <tr>
      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Folio</th>
      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Empresa Emisora</th>
      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Empresa Receptora</th>
      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Descargar archivos</th>
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
                <a href="{{ route('invoice.download',$invoice->id_documents . '.xml') }}" class="z-50 text-grey-lighter  font-bold py-1 px-3 rounded border bg-sky-200 hover:bg-sky-300 transition-all text-xs bg-green hover:bg-green-dark">XML</a>
                <a href="{{ route('invoice.download',$invoice->id_documents . '.pdf') }}" class="z-50text-grey-lighter font-bold py-1 px-3 rounded border bg-sky-200 hover:bg-sky-300 transition-all text-xs bg-blue hover:bg-blue-dark">PDF</a>
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
<a type="submit" href="{{ route('client.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>

</div>
<section class="m-4 text-right font-semibold text-gray-500">
  <a href="https://github.com/KevinHC13" class="text-purple-600 hover:underline">KevinHC13 - Todos los derechos reservados {{now()->year}}
</section>




    
@endsection