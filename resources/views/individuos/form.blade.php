@php
    $textFields = [
        'nombre', 'apellido', 'rut', 'codigo_serviu', 'fecha_carnet'
    ];

    $fileFields = [
        'carnet_identidad', 'carta_compromiso', 'contrato_construccion',
        'anteproyecto', 'apruebase', 'cert_electrico',
        'cert_sitio_eriazo', 'cert_avaluo_detallado',
        'cert_informaciones_p', 'comite_agua',
        'escritura', 'estudio', 'titulo',
        'registro_social_hogares', 'te1', 'tc6', 'reduccion',
        'permiso', 'recepcion_dom', 'prohibicion_1',
        'prohibicion_2', 'autoricese'
    ];
@endphp

{{-- Campos de texto y fecha --}}
@foreach($textFields as $campo)
    <div class="mb-3">
        <label>{{ ucwords(str_replace('_', ' ', $campo)) }}</label>
        @if($campo === 'fecha_carnet')
            <input type="date" name="{{ $campo }}" class="form-control" value="{{ old($campo, $individuo->$campo ?? '') }}">
        @else
            <input type="text" name="{{ $campo }}" class="form-control" value="{{ old($campo, $individuo->$campo ?? '') }}">
        @endif
    </div>
@endforeach

{{-- Campos tipo archivo --}}
@foreach($fileFields as $campo)
    <div class="mb-3">
        <label>{{ ucwords(str_replace('_', ' ', $campo)) }} (PDF o imagen)</label>
        <input type="file" name="{{ $campo }}" class="form-control">
        @if(isset($individuo) && $individuo->$campo)
            <small class="text-muted">Archivo actual: 
                <a href="{{ asset('storage/' . $individuo->$campo) }}" target="_blank">Ver archivo</a>
            </small>
        @endif
    </div>
@endforeach
