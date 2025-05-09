@extends('crea/layouts.app')

@section('crea/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Detalle de Individuo</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <p><strong>Nombre:</strong> {{ $individuo->nombre }}</p>
                        <p><strong>Apellido:</strong> {{ $individuo->apellido }}</p>
                        <p><strong>RUT:</strong> {{ $individuo->rut }}</p>
                        <p><strong>Fecha Carnet:</strong> {{ $individuo->fecha_carnet }}</p>
                        {{-- Agrega aquí más campos si deseas mostrarlos en detalle --}}

                        <a class="btn btn-secondary mt-3" href="{{ route('crea.individuos.index') }}">Volver</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
