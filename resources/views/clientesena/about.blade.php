@extends('clientesena.layouts.app')

@section('title', 'Nosotros')

@section('content')
    <p class="hero-label">Acerca de ClienteSena</p>
    <h1>Una ventana para explorar la formación SENA.</h1>
    <p class="notice">ClienteSena es el portal público conectado al catálogo de AdminSena. Su información de cursos, áreas y centros se consulta directamente desde la base de datos compartida; los registros nuevos se muestran al actualizar la página.</p>
    <div class="card-grid" style="margin-top:22px">
        <article class="content-card"><span class="badge">Misión</span><h2>Acercar la formación</h2><p>Presentar de manera clara la oferta de cursos, las áreas formativas y los centros SENA para apoyar a quienes buscan oportunidades de aprendizaje.</p></article>
        <article class="content-card"><span class="badge">Visión</span><h2>Una comunidad conectada</h2><p>Ser una puerta sencilla y accesible a la información académica que AdminSena mantiene actualizada.</p></article>
    </div>
@endsection
