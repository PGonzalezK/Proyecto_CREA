@extends('crea/layouts.app')

@section('crea/content')

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
                            <summary style="cursor:pointer; font-weight:bold; font-size: 1.1rem;">
                                Código SERVIU: {{ $codigo }} ({{ count($individuos) }} individuos)
                            </summary>

                            {{-- Formulario de subida --}}
                            <form action="{{ route('crea.serviu.upload', $codigo) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-8">
                                        <label for="archivos_{{ $codigo }}">Subir nuevo archivo:</label>
                                        <input type="file" name="archivo" id="archivos_{{ $codigo }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary mt-4">Subir Documento</button>
                                    </div>
                                </div>
                            </form>

                            {{-- Archivos existentes --}}
                            @php
                                $carpeta = "crea/Antecedentes Grupales/$codigo";
                                $archivos = Storage::disk('public')->exists($carpeta)
                                    ? Storage::disk('public')->files($carpeta)
                                    : [];
                            @endphp

                            @if (count($archivos))
                            <div class="mt-3">
                                <strong>Archivos Subidos:</strong>
                                <ul class="list-group mt-2">
                                    @foreach ($archivos as $archivo)
                                    @php
                                        $nombreArchivo = basename($archivo);
                                        $url = asset('storage/' . $archivo);
                                        $nombreLimpio = ucwords(str_replace(['_', '.pdf', '.jpg', '.jpeg', '.png'], [' ', '', '', '', ''], $nombreArchivo));
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            📄 <strong>{{ $nombreLimpio }}</strong><br>
                                            <small class="text-muted">{{ $nombreArchivo }}</small>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-primary">Ver</a>
                                            <form action="{{ route('crea.serviu.eliminar', ['codigo' => $codigo, 'tipo' => pathinfo($nombreArchivo, PATHINFO_FILENAME)]) }}" method="POST" onsubmit="return confirm('¿Eliminar archivo {{ $nombreArchivo }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            {{-- Tabla de individuos --}}
                            <table class="table table-striped mt-4">
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
                                            <a class="btn btn-info btn-sm" href="{{ route('crea.individuos.show', $individuo->id) }}">
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
