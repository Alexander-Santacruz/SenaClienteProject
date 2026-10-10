@extends('clientesena.layouts.app')

@section('title', $record->{array_key_first($config['fields'])})

@section('content')
    <a class="text-link" href="{{ route('clientesena.catalog.index', $resource) }}">← Volver a {{ strtolower($config['title']) }}</a>
    <article class="detail-card" style="margin-top: 18px">
        <span class="badge">{{ $config['title'] }}</span>
        <h1>{{ $record->{array_key_first($config['fields'])} }}</h1>
        <dl>
            @foreach ($config['fields'] as $field => $label)
                <div class="detail-row">
                    <dt>{{ $label }}</dt>
                    <dd>{{ $record->{$field} ?: 'Información no disponible' }}</dd>
                </div>
            @endforeach
        </dl>
        <p style="color:var(--muted)">Información sincronizada con AdminSena.</p>
    </article>
@endsection
