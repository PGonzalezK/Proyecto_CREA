<!-- Vista para editar personas con archivos (edit.blade.php) -->
@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Persona</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('personas.update', $persona->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $persona->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ $persona->apellido }}" required>
                </div>

                <div class="mb-3">
                    <label>RUT</label>
                    <input type="text" name="rut" class="form-control" value="{{ $persona->rut }}" required>
                </div>
                <div class="mb-3">
                    <label>Código Serviu</label>
                    <input type="text" name="codigo_serviu" class="form-control" value="{{ $persona->codigo_serviu }}">
                </div>
                <div class="mb-3">
                    <label>Fecha de Caducidad del Carnet</label>
                    <input type="date" class="form-control" name="fecha_carnet" value="{{ $persona->fecha_carnet ?? '' }}" required>
                </div>

                <hr>
                <h5 class="mb-3">Actualizar documentos</h5>
                <div class="row">
                    @foreach(['carnet_identidad', 'carta_compromiso', 'contrato_construccion', 'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1', 'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'] as $doc)
                        <div class="col-md-4 mb-3">
                            <label>{{ ucfirst(str_replace('_', ' ', $doc)) }}</label>
                            <input type="file" class="form-control" name="{{ $doc }}">
                            @if($persona->$doc)
                                <small><a href="{{ asset('storage/' . $persona->$doc) }}" target="_blank">Ver documento actual</a></small>
                            @endif
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-warning">Actualizar Persona</button>
                <a href="{{ route('personas.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
