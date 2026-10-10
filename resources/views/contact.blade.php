@extends('layouts.app')

@section('content')

<!-- Sección de Contáctanos -->
<section class="py-5 bg-light" id="contacto">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2 class="text-center mb-4 text-success">📬 Contáctanos</h2>
          <p class="text-center mb-5">
            ¿Tienes preguntas, sugerencias o quieres colaborar con nosotros? ¡Escríbenos!
          </p>

          <form>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" placeholder="Tu nombre completo" required>
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="correo" placeholder="nombre@ejemplo.com" required>
            </div>

            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea class="form-control" id="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-success px-5">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  @endsection
