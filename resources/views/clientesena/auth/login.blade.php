@extends('clientesena.layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <section class="auth-panel" aria-labelledby="auth-title">
        <p class="hero-label">Tu comunidad de formación</p>
        <h1 id="auth-title">Inicia sesión</h1>
        <p class="auth-intro">Accede a tu cuenta de ClienteSena para continuar.</p>

        @if ($errors->any())
            <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
        @endif

        <form class="auth-form" action="{{ route('clientesena.login.submit') }}" method="POST">
            @csrf
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">

            <label class="auth-checkbox" for="remember">
                <input id="remember" name="remember" type="checkbox" value="1">
                <span>Mantener mi sesión iniciada</span>
            </label>

            <button class="button button-green auth-submit" type="submit">Iniciar sesión</button>
        </form>

        <p class="auth-switch">¿Todavía no tienes una cuenta?
            <a class="text-link" href="{{ route('clientesena.register') }}">Regístrate aquí</a>
        </p>
    </section>
@endsection
