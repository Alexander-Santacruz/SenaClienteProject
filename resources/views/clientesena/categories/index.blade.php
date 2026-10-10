@extends('clientesena.layouts.app')

@section('title', 'Categorías')

@section('content')
    <p class="hero-label">Explora por tema</p>
    <div class="section-heading">
        <div><h1>Categorías de formación</h1><p>Categorías y cursos disponibles en el catálogo conectado a AdminSena.</p></div>
    </div>

    @if ($categories->isEmpty())
        <p class="notice">AdminSena todavía no tiene categorías registradas. Mientras tanto, puedes explorar los cursos disponibles.</p>
    @else
        <div class="card-grid">
            @foreach ($categories as $category)
                <article class="content-card">
                    <span class="badge">Categoría</span>
                    <h2>{{ $category->name }}</h2>
                    <p>Explora la oferta formativa disponible en ClienteSena.</p>
                    <a class="text-link" href="{{ route('clientesena.catalog.index', 'cursos') }}">Ver cursos →</a>
                </article>
            @endforeach
        </div>
    @endif

    <div class="section-heading"><div><h2>Cursos para explorar</h2><p>La oferta de cursos se actualiza desde AdminSena.</p></div></div>
    @if ($courses->isEmpty())
        <p class="notice">Aún no hay cursos en el catálogo.</p>
    @else
        <div class="card-grid">
            @foreach ($courses as $course)
                <article class="content-card">
                    <span class="badge">Código {{ $course->code }}</span>
                    <h3>{{ $course->name }}</h3>
                    <a class="text-link" href="{{ route('clientesena.catalog.show', ['resource' => 'cursos', 'record' => $course->id]) }}">Ver curso →</a>
                </article>
            @endforeach
        </div>
    @endif
@endsection
