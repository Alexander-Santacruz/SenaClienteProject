<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white; border-bottom: 4px solid #28a745;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home.index') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo blog" class="logo">
        </a>
        <!-- Botón de menú -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.mision_vision') }}">Mision y vision</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts') }}">Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.contact') }}">Contactanos</a>
                </li>
                <li class="nav-item">
                    {{-- @auth --}}
                    {{-- <a class="nav-link" href="{{ route('pqrsds.index') }}">Administrar</a> --}}
                    {{-- @endauth --}}
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="{{ route('notice.create') }}">Crear Noticia</a></li> --}}
                        </ul>
                    </li>
                @endauth
            </ul>
            {{-- <span class="navbar-text ">
                @auth
                    <form action="{{ route('login.logout') }}" method="POST">
                        @csrf
                        <a href="#" onclick="this.closest('form').submit()">Logout</a>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </span> --}}
        </div>
    </div>
</nav>
