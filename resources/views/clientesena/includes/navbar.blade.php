<header class="site-header">
    <div class="container nav-inner">
        <a class="brand" href="{{ route('clientesena.home') }}">
            <span class="brand-mark" aria-hidden="true">S</span>
            <span>ClienteSena<small>Comunidad de formación</small></span>
        </a>
        <nav class="main-nav" aria-label="Navegación principal">
            <a href="{{ route('clientesena.home') }}">Inicio</a>
            <a href="{{ route('clientesena.publications') }}">Novedades</a>
            <a href="{{ route('clientesena.categories') }}">Categorías</a>
            <details class="catalog-menu">
                <summary>Explorar ▾</summary>
                <div class="catalog-dropdown">
                    <a href="{{ route('clientesena.catalog.index', 'cursos') }}">Cursos</a>
                    <a href="{{ route('clientesena.catalog.index', 'areas') }}">Áreas</a>
                    <a href="{{ route('clientesena.catalog.index', 'centros') }}">Centros</a>
                    <a href="{{ route('clientesena.catalog.index', 'equipos') }}">Equipos</a>
                    <a href="{{ route('clientesena.catalog.index', 'instructores') }}">Instructores</a>
                    <a href="{{ route('clientesena.catalog.index', 'aprendices') }}">Aprendices</a>
                </div>
            </details>
            <a href="{{ route('clientesena.about') }}">Nosotros</a>
            <a href="{{ route('clientesena.contact') }}">Contacto</a>
            @guest
                <a href="{{ route('clientesena.login') }}">Iniciar sesión</a>
                <a class="admin-link" href="{{ route('clientesena.register') }}">Crear cuenta</a>
            @else
                <span class="nav-user">Hola, {{ auth()->user()->name }}</span>
                <form class="nav-logout" action="{{ route('clientesena.logout') }}" method="POST">
                    @csrf
                    <button class="admin-link" type="submit">Cerrar sesión</button>
                </form>
            @endguest
        </nav>
    </div>
</header>
