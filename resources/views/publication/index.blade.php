@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-success">📝 Lista de Publicaciones</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Contenido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['name'] }}</td>
                        <td>{{ Str::limit($post['body'], 100) }}</td> {{-- Limita el contenido largo --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
