@extends('layouts.backend')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registrar Nueva Persona</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('personas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input name="apellido" id="apellido" class="form-control" placeholder="Ingrese el apellido" required>
                    </div>
                    <div class="col-md-4">
                        <label for="rut" class="form-label">RUT</label>
                        <input name="rut" id="rut" class="form-control" placeholder="Ingrese el RUT" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="carta_compromiso" class="form-label">Carta Compromiso</label>
                        <input type="file" class="form-control" name="carta_compromiso" id="carta_compromiso" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contrato_construccion" class="form-label">Contrato Construcción</label>
                        <input type="file" class="form-control" name="contrato_construccion" id="contrato_construccion" required>
                    </div>
                </div>

                <hr>
                <h5 class="mb-3">Otros documentos (opcionales)</h5>

                <div class="row">
                    @foreach(['post_subsidio', 'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1', 'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'] as $doc)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">{{ ucfirst(str_replace('_', ' ', $doc)) }}</label>
                            <input type="file" class="form-control" name="{{ $doc }}">
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success">Guardar Persona</button>
                <a href="{{ route('personas.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
