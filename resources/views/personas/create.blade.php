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
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                    </li>
                    <li class="list-group-item">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input name="apellido" id="apellido" class="form-control" placeholder="Ingrese el apellido" required>
                    </li>
                    <li class="list-group-item">
                        <label for="rut" class="form-label">RUT</label>
                        <input name="rut" id="rut" class="form-control" placeholder="Ingrese el RUT" required>
                    </li>
                    <li class="list-group-item">
                         <label for="codigo_serviu" class="form-label">Código Serviu</label>
                         <input type="text" name="codigo_serviu" id="codigo_serviu" class="form-control" placeholder="Ingrese el código de grupo">
                    </li>
                    <li class="list-group-item">
                        <label for="carnet_identidad" class="form-label">Carnet de identidad</label>
                        <div class="d-flex gap-3">
                            <input type="file" class="form-control" name="carnet_identidad" id="carnet_identidad" required>
                            <input type="date" class="form-control" name="fecha_carnet" id="fecha_carnet" required>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <label for="carta_compromiso" class="form-label">Carta Compromiso</label>
                        <input type="file" class="form-control" name="carta_compromiso" id="carta_compromiso" required>
                    </li>
                    <li class="list-group-item">
                        <label for="contrato_construccion" class="form-label">Contrato Construcción</label>
                        <input type="file" class="form-control" name="contrato_construccion" id="contrato_construccion" required>
                    </li>
                </ul>
                
                <hr>
                <h5 class="mb-3">Otros documentos (opcionales)</h5>
                
                <ul class="list-group list-group-flush">
                    @foreach(['anteproyecto', 'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1', 'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'] as $doc)
                        <li class="list-group-item">
                            <label class="form-label">{{ ucfirst(str_replace('_', ' ', $doc)) }}</label>
                            <input type="file" class="form-control" name="{{ $doc }}">
                        </li>
                    @endforeach
                </ul>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Guardar Persona</button>
                    <a href="{{ route('personas.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fechaCarnetInput = document.getElementById('fecha_carnet');
        
        //fechaCarnetInput.addEventListener('change', function () {
        //    alert('Fecha ingresada para Carnet de Identidad: ' + this.value);
        //});
    });
</script>

@endsection
