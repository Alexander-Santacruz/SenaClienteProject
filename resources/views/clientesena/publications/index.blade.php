@extends('clientesena.layouts.app')

@section('title', 'Novedades')

@section('content')
    <p class="hero-label">Actualidad formativa</p>
    <div class="section-heading">
        <div><h1>Novedades de AdminSena</h1><p>Publicaciones generadas a partir de cursos, áreas y centros registrados.</p></div>
    </div>

    @if ($publications->isEmpty())
        <p class="notice">No hay novedades todavía. Los nuevos cursos, áreas y centros registrados aparecerán aquí.</p>
    @else
        <div class="card-grid">
            @foreach ($publications as $publication)
                <article class="content-card">
                    <span class="badge">{{ $publication['type'] }}</span>
                    <h2>{{ $publication['title'] }}</h2>
                    <p>{{ $publication['excerpt'] }}</p>
                    <a class="text-link" href="{{ route('clientesena.catalog.show', ['resource' => $publication['resource'], 'record' => $publication['id']]) }}">Leer más →</a>
                </article>
            @endforeach
        </div>
    @endif
@endsection
