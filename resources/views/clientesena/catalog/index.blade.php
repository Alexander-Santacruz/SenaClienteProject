@extends('clientesena.layouts.app')

@section('title', $config['title'])

@section('content')
    <p class="hero-label">Catálogo ClienteSena</p>
    <div class="section-heading">
        <div><h1>{{ $config['title'] }}</h1><p>{{ $config['description'] }} · {{ $records->total() }} registros.</p></div>
    </div>

    <form class="search-form" method="GET" action="{{ route('clientesena.catalog.index', $resource) }}">
        <input type="search" name="buscar" value="{{ $search }}" placeholder="Buscar en {{ strtolower($config['title']) }}" aria-label="Buscar">
        <button class="button button-green" type="submit">Buscar</button>
        @if ($search !== '')
            <a class="button button-outline" href="{{ route('clientesena.catalog.index', $resource) }}">Limpiar</a>
        @endif
    </form>

    @if ($records->isEmpty())
        <p class="notice">{{ $search !== '' ? 'No encontramos resultados para esa búsqueda.' : 'Todavía no hay datos registrados en esta sección.' }}</p>
    @else
        <div class="card-grid">
            @foreach ($records as $record)
                <article class="content-card">
                    <span class="badge">{{ $config['title'] }}</span>
                    <h2>{{ $record->{array_key_first($config['fields'])} }}</h2>
                    @foreach (array_slice($config['fields'], 1, null, true) as $field => $label)
                        @if ($record->{$field})
                            <p><strong>{{ $label }}:</strong> {{ $record->{$field} }}</p>
                        @endif
                    @endforeach
                    <a class="text-link" href="{{ route('clientesena.catalog.show', ['resource' => $resource, 'record' => $record->id]) }}">Ver detalle →</a>
                </article>
            @endforeach
        </div>
        {{ $records->links('pagination::bootstrap-5') }}
    @endif
@endsection
