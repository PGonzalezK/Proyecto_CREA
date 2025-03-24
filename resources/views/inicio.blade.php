@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Panel de Control</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <!-- Color de fondo aplicado -->
                        <h3 class="block-title" style="background-color: #f8d7da; color: #000; padding: 5px 10px; border-radius: 5px;">
                            Carnets Próximos a Vencer
                        </h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>RUT</th>
                                    <th>Fecha de Caducidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personas as $persona)
                                    @php
                                        $hoy = \Carbon\Carbon::now();
                                        $fecha_carnet = \Carbon\Carbon::parse($persona->fecha_carnet);
                                        $dias_restantes = $hoy->diffInDays($fecha_carnet, false);
                                    @endphp
                                    <tr>
                                        <td>{{ $persona->nombre }} {{ $persona->apellido }}</td>
                                        <td>{{ $persona->rut }}</td>
                                        <td>
                                            {{ $fecha_carnet->format('d-m-Y') }}
                                            @if($dias_restantes <= 30 && $dias_restantes >= 0)
                                                <span class="badge bg-warning text-dark ms-2">Vence en {{ $dias_restantes }} días</span>
                                            @elseif($dias_restantes < 0)
                                                <span class="badge bg-danger text-white ms-2">¡Vencido!</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('personas.show', $persona->id) }}" class="btn btn-info btn-sm">Ver Perfil</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($personas->isEmpty())
                            <p class="text-center">No hay carnets próximos a vencer.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
