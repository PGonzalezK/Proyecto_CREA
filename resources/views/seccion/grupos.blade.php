@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-xl">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Personas Agrupadas por Código SERVIU</h4>
        </div>
        <div class="card-body">

            @forelse($grupos as $codigo => $personas)
                <div class="mb-4">
                    <h5 class="bg-secondary text-white p-2">Código SERVIU: {{ $codigo }}</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>RUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personas as $persona)
                                <tr>
                                    <td>{{ $persona->id }}</td>
                                    <td>{{ $persona->nombre }}</td>
                                    <td>{{ $persona->apellido }}</td>
                                    <td>{{ $persona->rut }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @empty
                <p class="text-center">No hay personas con código SERVIU.</p>
            @endforelse

        </div>
    </div>
</div>
@endsection