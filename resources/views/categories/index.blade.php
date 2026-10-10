@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Categorías</h1>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <div>
                    <a href="{{ route('category.create') }}" class="btn btn-outline-success btn-sm">Nueva categoria</a>
                    <br><br>
                </div>

                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category['id'] }}</td>
                        <td>{{ $category['name'] }}</td>

                        <td>
                            <a href="{{ route('category.show', $category['id']) }}" class="btn btn-info btn-sm">Ver más</a>
                        </td>
                        <td>
                            <a href="{{ route('category.edit', $category['id']) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <form action="{{ route('category.destroy', $category['id']) }}" method="POST"
                                style="display: inline-block;"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
