@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detalles de Persona</h4>
        </div>
        <div class="card-body">
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>ID:</strong> {{ $persona->id }}</li>
                <li class="list-group-item"><strong>Nombre:</strong> {{ $persona->nombre }}</li>
                <li class="list-group-item"><strong>Apellido:</strong> {{ $persona->apellido }}</li>
                <li class="list-group-item"><strong>RUT:</strong> {{ $persona->rut }}</li>
                
            </ul>

            <h5>Documentos</h5>
            <ul class="list-group">
                @foreach(['carta_compromiso', 'contrato_construccion', 'post_subsidio', 'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1', 'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'] as $doc)
                    <li class="list-group-item">
                        <strong>{{ ucfirst(str_replace('_', ' ', $doc)) }}:</strong>
                        @if($persona->$doc)
                            <a href="{{ asset('storage/' . $persona->$doc) }}" target="_blank">Ver documento</a>
                        @else
                            <span class="text-muted">No disponible</span>
                        @endif
                    </li>
                @endforeach
            </ul>

            <a href="{{ route('personas.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection
