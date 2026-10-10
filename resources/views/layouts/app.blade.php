<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia de Taekwondo</title>
    <!-- Enlaces a los archivos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    @include('includes.navbar')

    <div class="container mt-4">
    @yield('content')
    </div>
    @include('includes.footer')
    <!-- Enlaces a los archivos JavaScript de Bootstrap (opcional, para funcionalidades adicionales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
