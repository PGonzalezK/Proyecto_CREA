@extends('edifica/layouts.app')

@section('edifica/content')
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
                        <hr>
                        <h5>Archivos del Individuo</h5>

                        @php
                        $portal = session('portal', 'crea');
                        $nombreCompleto = str_replace(' ', '_', $individuo->nombre . '_' . $individuo->apellido);
                        $ruta = "public/$portal/Individuos/$nombreCompleto";
                        $archivos = \Storage::exists($ruta) ? \Storage::files($ruta) : [];
                        @endphp

                        @if (empty($archivos))
                        <p class="text-muted">No hay archivos cargados para este individuo.</p>
                        @else
                        <ul class="list-group mt-3">
                            @foreach ($archivos as $archivo)
                            @php
                            $nombreArchivo = basename($archivo);
                            $nombreLimpio = ucwords(str_replace(['_', '.pdf', '.jpg', '.jpeg', '.png'], [' ', '', '', '', ''], $nombreArchivo));
                            $url = asset('storage/' . str_replace('public/', '', $archivo));
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    📄 <strong>{{ $nombreLimpio }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $nombreArchivo }}</small>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
                                    <form action="{{ route($portal . '.individuos.eliminarArchivo', [
                                        'portal' => $portal,
                                        'id' => $individuo->id,
                                        'archivo' => $nombreArchivo
                                    ]) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este archivo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <a class="btn btn-secondary mt-3" href="{{ route('edifica.individuos.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection