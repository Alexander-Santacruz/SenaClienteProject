<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a class="footer-brand" href="{{ route('clientesena.home') }}">ClienteSena</a>
            <p>Información para explorar la oferta y la comunidad de formación del SENA.</p>
        </div>
        <div class="footer-links">
            <a href="{{ route('clientesena.publications') }}">Novedades</a>
            <a href="{{ route('clientesena.catalog.index', 'cursos') }}">Cursos</a>
            <a href="{{ route('clientesena.catalog.index', 'centros') }}">Centros de formación</a>
            <a href="{{ route('clientesena.catalog.index', 'equipos') }}">Equipos</a>
            <a href="{{ route('clientesena.catalog.index', 'instructores') }}">Instructores</a>
            <a href="{{ route('clientesena.catalog.index', 'aprendices') }}">Aprendices</a>
        </div>
    </div>
    <div class="container footer-bottom">
        <span>&copy; {{ now()->year }} ClienteSena</span>
        <span>Conectado al catálogo de AdminSena</span>
    </div>
</footer>
