@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-xl">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Personas Agrupadas por Código SERVIU</h4>
        </div>
        <div class="card-body">

            @if($grupos->isEmpty())
                <p class="text-center">No hay personas con código SERVIU.</p>
            @else
                @foreach($grupos as $codigo => $personas)
                    <details class="mb-3 border rounded p-2">
                        <summary style="cursor:pointer; font-weight:bold;">
                            Código SERVIU: {{ $codigo }} ({{ count($personas) }} personas)
                        </summary>

                        <table class="table table-bordered table-striped mt-2">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>RUT</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personas as $persona)
                                    <tr>
                                        <td>{{ $persona->nombre }}</td>
                                        <td>{{ $persona->apellido }}</td>
                                        <td>{{ $persona->rut }}</td>
                                        <td>
                                            <a href="{{ route('personas.show', $persona->id) }}" class="btn btn-sm btn-info">ver</a>
                                            <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que desea eliminar esta persona?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </details>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
