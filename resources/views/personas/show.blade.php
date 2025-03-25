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
                <li class="list-group-item"><strong>Código Serviu:</strong> {{ $persona->codigo_serviu ?? 'No disponible' }}</li>
                <li class="list-group-item">
                    <strong>Fecha de Caducidad del Carnet:</strong>
                    @if($persona->fecha_carnet)
                        @php
                            $hoy = \Carbon\Carbon::now();
                            $fecha_carnet = \Carbon\Carbon::parse($persona->fecha_carnet);
                            $dias_restantes = $hoy->diffInDays($fecha_carnet, false);
                        @endphp
                        
                        @if($dias_restantes <= 30 && $dias_restantes >= 0)
                            <span class="text-danger">{{ $fecha_carnet->format('d-m-Y') }} (Vence en {{ $dias_restantes }} días)</span>
                        @elseif($dias_restantes < 0)
                            <span class="text-danger">{{ $fecha_carnet->format('d-m-Y') }} (¡Vencido!)</span>
                        @else
                            <span>{{ $fecha_carnet->format('d-m-Y') }}</span>
                        @endif
                    @else
                        <span class="text-muted">No disponible</span>
                    @endif
                </li>
            </ul>

            <h5>Documentos</h5>
            <ul class="list-group">
                @foreach(['carnet_identidad','carta_compromiso', 'contrato_construccion', 'anteproyecto', 'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1', 'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'] as $doc)
                    <li class="list-group-item">
                        <strong>{{ ucfirst(str_replace('_', ' ', $doc)) }}:</strong>
                        @if($persona->$doc)
                            <a href="{{ asset('storage/' . $persona->$doc) }}" target="_blank" class="btn btn-success btn-sm">Ver documento</a>
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
