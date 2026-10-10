@extends('clientesena.layouts.app')

@section('title', 'Contacto')

@section('content')
    <p class="hero-label">Contacto</p>
    <h1>¿Buscas información de formación?</h1>
    <p class="notice">Consulta los cursos y centros publicados en ClienteSena. Los registros del catálogo son de solo lectura para los clientes.</p>
    <div style="margin-top:20px;display:flex;flex-wrap:wrap;gap:10px">
        <a class="button button-green" href="{{ route('clientesena.catalog.index', 'cursos') }}">Consultar cursos</a>
        <a class="button button-outline" href="{{ route('clientesena.catalog.index', 'centros') }}">Ver centros</a>
    </div>
@endsection
