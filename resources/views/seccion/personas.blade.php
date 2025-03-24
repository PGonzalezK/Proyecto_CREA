@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-xl">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0" style="color:white">Lista de Personas</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('personas.create') }}" class="btn btn-success mb-3">Nueva Persona</a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Buscador por nombre -->
            <form method="GET" action="{{ route('personas.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre..." value="{{ request('busqueda') }}">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>RUT</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $persona)
                        <tr>
                            <td>{{ $persona->id }}</td>
                            <td>{{ $persona->nombre }}</td>
                            <td>{{ $persona->apellido }}</td>
                            <td>{{ $persona->rut }}</td>
                            <td>
                                <a href="{{ route('personas.show', $persona->id) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que desea eliminar esta persona?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($personas->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No hay personas registradas.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection