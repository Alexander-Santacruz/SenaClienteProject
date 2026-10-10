@extends('layouts.app')

@section('content')


 <!-- Carousel -->
 <div id="carouselBlog" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/mision_vision.png') }}" class="d-block w-100" alt="Imagen 1">
        <div class="carousel-caption d-none d-md-block">
          <h5>Bienvenido a nuestro Blog</h5>
          <p>Explora artículos, ideas y más.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/mision_vision.png') }}" class="d-block w-100" alt="Imagen 2">
        <div class="carousel-caption d-none d-md-block">
          <h5>Tecnología y creatividad</h5>
          <p>El contenido que impulsa tu curiosidad.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/mision_vision.png') }}" class="d-block w-100" alt="Imagen 3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Conecta con la comunidad</h5>
          <p>Participa, comenta y comparte.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBlog" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBlog" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- Bienvenida -->
  <section class="py-5 text-center">
    <div class="container">
      <h2 class="mb-3">Descubre, Aprende, Comparte</h2>
      <p class="lead">En nuestro blog encontrarás contenido de calidad para inspirarte, informarte y conectar con otros.</p>
      <a href="{{ route('posts') }}" class="btn btn-success">Ver publicaciones</a>
    </div>
  </section>

  @endsection
