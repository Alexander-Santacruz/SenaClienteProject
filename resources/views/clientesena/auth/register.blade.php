@extends('clientesena.layouts.app')

@section('title', 'Crear cuenta')

@section('content')
    <section class="auth-panel" aria-labelledby="auth-title">
        <p class="hero-label">Únete a la comunidad</p>
        <h1 id="auth-title">Crea tu cuenta</h1>
        <p class="auth-intro">Regístrate para participar como cliente de ClienteSena.</p>

        @if ($errors->any())
            <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
        @endif

        <form class="auth-form" action="{{ route('clientesena.register.submit') }}" method="POST">
            @csrf
            <label for="name">Nombre</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" autocomplete="name" autofocus>

            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">

            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password">
            <small class="auth-hint">Debe tener al menos 8 caracteres.</small>

            <label for="password_confirmation">Confirma tu contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password">

            <button class="button button-green auth-submit" type="submit">Crear cuenta</button>
        </form>

        <p class="auth-switch">¿Ya tienes una cuenta?
            <a class="text-link" href="{{ route('clientesena.login') }}">Inicia sesión</a>
        </p>
    </section>
@endsection
