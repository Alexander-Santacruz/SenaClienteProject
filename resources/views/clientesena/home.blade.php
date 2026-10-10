@extends('clientesena.layouts.app')

@section('title', 'Inicio')

@section('content')
    @php
        $slides = [
            [
                'title' => 'ClienteSena',
                'subtitle' => 'Explora la formación, las novedades y los centros del SENA.',
                'button' => 'Crear cuenta',
                'url' => route('clientesena.register'),
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1600&q=85',
            ],
            [
                'title' => 'Cursos de formación',
                'subtitle' => 'Consulta los cursos publicados desde AdminSena y encuentra una opción para ti.',
                'button' => 'Ver cursos',
                'url' => route('clientesena.catalog.index', 'cursos'),
                'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1600&q=85',
            ],
            [
                'title' => 'Áreas de formación',
                'subtitle' => 'Conoce las áreas disponibles y explora sus programas relacionados.',
                'button' => 'Explorar áreas',
                'url' => route('clientesena.catalog.index', 'areas'),
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=85',
            ],
            [
                'title' => 'Centros SENA',
                'subtitle' => 'Encuentra centros y ciudades en los datos compartidos por AdminSena.',
                'button' => 'Ver centros',
                'url' => route('clientesena.catalog.index', 'centros'),
                'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1600&q=85',
            ],
            [
                'title' => 'Equipos de formación',
                'subtitle' => 'Consulta los equipos disponibles en los centros de formación.',
                'button' => 'Ver equipos',
                'url' => route('clientesena.catalog.index', 'equipos'),
                'image' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=1600&q=85',
            ],
            [
                'title' => 'Instructores',
                'subtitle' => 'Conoce a los instructores y sus áreas de especialidad.',
                'button' => 'Ver instructores',
                'url' => route('clientesena.catalog.index', 'instructores'),
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=1600&q=85',
            ],
            [
                'title' => 'Aprendices',
                'subtitle' => 'Conoce la comunidad de aprendices y sus fichas.',
                'button' => 'Ver aprendices',
                'url' => route('clientesena.catalog.index', 'aprendices'),
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=85',
            ],
        ];
    @endphp

    <div class="admin-home">
        <section class="carousel-custom" aria-label="Presentación de ClienteSena" data-carousel>
            @foreach ($slides as $index => $slide)
                <article class="carousel-slide {{ $index === 0 ? 'active' : '' }}"
                    aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    data-slide="{{ $index }}">
                    <img src="{{ $slide['image'] }}" alt="" class="carousel-img">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <p class="carousel-eyebrow">Servicio Nacional de Aprendizaje</p>
                        <h1 class="{{ $index === 0 ? 'carousel-title-green' : '' }}">{{ $slide['title'] }}</h1>
                        <p>{{ $slide['subtitle'] }}</p>
                        <a class="carousel-cta" href="{{ $slide['url'] }}">{{ $slide['button'] }}</a>
                    </div>
                </article>
            @endforeach

            <button class="carousel-nav-btn carousel-prev" type="button" aria-label="Diapositiva anterior" data-carousel-prev>❮</button>
            <button class="carousel-nav-btn carousel-next" type="button" aria-label="Diapositiva siguiente" data-carousel-next>❯</button>
            <div class="carousel-indicators" aria-label="Seleccionar diapositiva">
                @foreach ($slides as $index => $slide)
                    <button type="button" aria-label="Mostrar {{ $slide['title'] }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" data-carousel-to="{{ $index }}"></button>
                @endforeach
            </div>
        </section>

        <section class="home-news-heading">
            <span class="badge-custom badge-green">Novedades de formación</span>
            <h2>Explora la oferta del SENA</h2>
        </section>

        @if ($featuredCourses->isNotEmpty())
            @php($highlightedCourse = $featuredCourses->first())
            <aside class="alert-banner" aria-label="Curso destacado">
                <span class="home-alert-icon" aria-hidden="true">📢</span>
                <div>
                    <span class="badge-custom badge-green">Curso destacado</span>
                    <h3>{{ $highlightedCourse->name }}</h3>
                    <p>Consulta el código {{ $highlightedCourse->code }} y revisa los detalles de este curso en el catálogo.</p>
                    <a class="text-link" href="{{ route('clientesena.catalog.show', ['resource' => 'cursos', 'record' => $highlightedCourse->id]) }}">Ver curso →</a>
                </div>
            </aside>
        @else
            <p class="notice">Cuando se publiquen cursos en AdminSena, las novedades aparecerán aquí.</p>
        @endif

        <div class="grid-cards">
            <article class="card-custom">
                <div class="card-header-custom">
                    <span class="badge-custom badge-green">Oferta educativa</span>
                    <span>{{ $courseCount }} cursos</span>
                </div>
                <div class="card-body-custom">
                    <h3>Cursos de formación</h3>
                    @if ($featuredCourses->isNotEmpty())
                        <ul class="home-record-list">
                            @foreach ($featuredCourses as $course)
                                <li><a href="{{ route('clientesena.catalog.show', ['resource' => 'cursos', 'record' => $course->id]) }}">{{ $course->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aún no hay cursos publicados.</p>
                    @endif
                </div>
                <div class="card-footer-custom">
                    <a href="{{ route('clientesena.catalog.index', 'cursos') }}">Consultar cursos →</a>
                </div>
            </article>

            <article class="card-custom">
                <div class="card-header-custom">
                    <span class="badge-custom badge-blue">Formación</span>
                    <span>{{ $areaCount }} áreas</span>
                </div>
                <div class="card-body-custom">
                    <h3>Áreas de formación</h3>
                    @if ($areas->isNotEmpty())
                        <ul class="home-record-list">
                            @foreach ($areas as $area)
                                <li><a href="{{ route('clientesena.catalog.show', ['resource' => 'areas', 'record' => $area->id]) }}">{{ $area->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aún no hay áreas publicadas.</p>
                    @endif
                </div>
                <div class="card-footer-custom">
                    <a href="{{ route('clientesena.catalog.index', 'areas') }}">Explorar áreas →</a>
                </div>
            </article>

            <article class="card-custom">
                <div class="card-header-custom">
                    <span class="badge-custom badge-info">Centros SENA</span>
                    <span>{{ $centerCount }} centros</span>
                </div>
                <div class="card-body-custom">
                    <h3>Centros de formación</h3>
                    @if ($centers->isNotEmpty())
                        <ul class="home-record-list">
                            @foreach ($centers as $center)
                                <li><a href="{{ route('clientesena.catalog.show', ['resource' => 'centros', 'record' => $center->id]) }}">{{ $center->name }}</a><span>{{ $center->city }}</span></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aún no hay centros publicados.</p>
                    @endif
                </div>
                <div class="card-footer-custom">
                    <a href="{{ route('clientesena.catalog.index', 'centros') }}">Ver centros →</a>
                </div>
            </article>

            <article class="card-custom">
                <div class="card-header-custom">
                    <span class="badge-custom badge-blue">Inventario</span>
                    <span>{{ $computerCount }} equipos</span>
                </div>
                <div class="card-body-custom">
                    <h3>Equipos</h3>
                    @if ($computers->isNotEmpty())
                        <ul class="home-record-list">
                            @foreach ($computers as $computer)
                                <li><a href="{{ route('clientesena.catalog.show', ['resource' => 'equipos', 'record' => $computer->id]) }}">{{ $computer->serial }}</a><span>{{ $computer->brand }}</span></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aún no hay equipos publicados.</p>
                    @endif
                </div>
                <div class="card-footer-custom">
                    <a href="{{ route('clientesena.catalog.index', 'equipos') }}">Ver equipos →</a>
                </div>
            </article>

            <article class="card-custom">
                <div class="card-header-custom">
                    <span class="badge-custom badge-green">Formación</span>
                    <span>{{ $teacherCount }} instructores</span>
                </div>
                <div class="card-body-custom">
                    <h3>Instructores</h3>
                    @if ($teachers->isNotEmpty())
                        <ul class="home-record-list">
                            @foreach ($teachers as $teacher)
                                <li><a href="{{ route('clientesena.catalog.show', ['resource' => 'instructores', 'record' => $teacher->id]) }}">{{ $teacher->name }}</a><span>{{ $teacher->specialty }}</span></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aún no hay instructores publicados.</p>
                    @endif
                </div>
                <div class="card-footer-custom">
                    <a href="{{ route('clientesena.catalog.index', 'instructores') }}">Ver instructores →</a>
                </div>
            </article>

            <article class="card-custom">
                <div class="card-header-custom">
                    <span class="badge-custom badge-info">Comunidad SENA</span>
                    <span>{{ $apprenticeCount }} aprendices</span>
                </div>
                <div class="card-body-custom">
                    <h3>Aprendices</h3>
                    @if ($apprentices->isNotEmpty())
                        <ul class="home-record-list">
                            @foreach ($apprentices as $apprentice)
                                <li><a href="{{ route('clientesena.catalog.show', ['resource' => 'aprendices', 'record' => $apprentice->id]) }}">{{ $apprentice->name }}</a><span>Ficha {{ $apprentice->ficha }}</span></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aún no hay aprendices publicados.</p>
                    @endif
                </div>
                <div class="card-footer-custom">
                    <a href="{{ route('clientesena.catalog.index', 'aprendices') }}">Ver aprendices →</a>
                </div>
            </article>
        </div>

        @guest
            <section class="home-auth-card">
                <div>
                    <h2>¿Quieres ser parte de ClienteSena?</h2>
                    <p>Crea una cuenta de cliente o inicia sesión para acceder a tu comunidad.</p>
                </div>
                <div class="home-auth-actions">
                    <a class="button button-green" href="{{ route('clientesena.register') }}">Crear cuenta</a>
                    <a class="button button-outline" href="{{ route('clientesena.login') }}">Iniciar sesión</a>
                </div>
            </section>
        @else
            <section class="home-auth-card">
                <div>
                    <h2>¡Hola, {{ auth()->user()->name }}!</h2>
                    <p>Consulta las novedades y explora la oferta de formación disponible.</p>
                </div>
                <a class="button button-green" href="{{ route('clientesena.publications') }}">Ver novedades</a>
            </section>
        @endguest
    </div>

    <script>
        (() => {
            const carousel = document.querySelector('[data-carousel]');
            if (!carousel) return;

            const slides = [...carousel.querySelectorAll('[data-slide]')];
            const indicators = [...carousel.querySelectorAll('[data-carousel-to]')];
            let current = 0;

            const showSlide = (index) => {
                current = (index + slides.length) % slides.length;
                slides.forEach((slide, i) => {
                    const active = i === current;
                    slide.classList.toggle('active', active);
                    slide.setAttribute('aria-hidden', String(!active));
                    indicators[i].setAttribute('aria-current', String(active));
                });
            };

            carousel.querySelector('[data-carousel-prev]').addEventListener('click', () => showSlide(current - 1));
            carousel.querySelector('[data-carousel-next]').addEventListener('click', () => showSlide(current + 1));
            indicators.forEach((button) => button.addEventListener('click', () => showSlide(Number(button.dataset.carouselTo))));

            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                window.setInterval(() => showSlide(current + 1), 6000);
            }
        })();
    </script>
@endsection
