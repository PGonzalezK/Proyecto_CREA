@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Individuos Agrupados por Código SERVIU</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($grupales->isEmpty())
                        <p class="text-center">No hay individuos con código SERVIU.</p>
                        @else
                        @foreach($grupales as $codigo => $individuos)
                        <details class="mb-4 border rounded p-3">
                            <form action="{{ route('serviu.upload', $codigo) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-4">
                                        <label for="carta_{{ $codigo }}">Carta de Compromiso:</label>
                                        <input type="file" name="carta_compromiso" id="carta_{{ $codigo }}" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="contrato_{{ $codigo }}">Contrato de Construcción:</label>
                                        <input type="file" name="contrato_construccion" id="contrato_{{ $codigo }}" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary mt-4">Subir Documentos</button>
                                    </div>
                                </div>
                            </form>

                            <summary style="cursor:pointer; font-weight:bold; font-size: 1.1rem;">
                                Código SERVIU: {{ $codigo }} ({{ count($individuos) }} individuos)
                            </summary>

                            <table class="table table-striped mt-3">
                                <thead style="background-color:#6777ef">
                                    <tr>
                                        <th style="color:#fff;">ID</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">Apellido</th>
                                        <th style="color:#fff;">RUT</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($individuos as $individuo)
                                    <tr>
                                        <td>{{ $individuo->id }}</td>
                                        <td>{{ $individuo->nombre }}</td>
                                        <td>{{ $individuo->apellido }}</td>
                                        <td>{{ $individuo->rut }}</td>
                                        <td>
                                            @can('ver-individuo')
                                            <a class="btn btn-info btn-sm" href="{{ route('individuos.show', $individuo->id) }}">
                                                Ver Detalle
                                            </a>
                                            @endcan
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
        </div>
    </div>
</section>
@endsection