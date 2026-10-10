<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Explora cursos, áreas y centros de formación del SENA.">
    <title>@yield('title', 'Cliente SENA') | ClienteSena</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clientesena.css') }}">
</head>
<body>
    @include('clientesena.includes.navbar')
    <main class="container page-main">
        @yield('content')
    </main>
    @include('clientesena.includes.footer')
</body>
</html>
