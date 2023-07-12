<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Facturas</title>
    @stack('styles')
    @stack('js')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    
</head>

<body class="bg-gray-100"> 
        @yield('contenido')



</body>

</html>
