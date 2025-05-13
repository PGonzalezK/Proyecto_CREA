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

{{-- CAMPOS DE TEXTO --}}
<div class="row">
    @foreach($textFields as $campo)
        <div class="col-md-4 mb-3">
            <label for="{{ $campo }}" class="form-label">{{ ucwords(str_replace('_', ' ', $campo)) }}</label>
            @if($campo === 'fecha_carnet')
                <input type="date" name="{{ $campo }}" id="{{ $campo }}" class="form-control"
                       value="{{ old($campo, $individuo->$campo ?? '') }}">
            @else
                <input type="text" name="{{ $campo }}" id="{{ $campo }}" class="form-control"
                       value="{{ old($campo, $individuo->$campo ?? '') }}">
            @endif
        </div>
    @endforeach
</div>

{{-- CAMPOS DE ARCHIVOS --}}
<hr>
<h5 class="mb-3">Documentos</h5>
<div class="row">
    @foreach($fileFields as $campo)
        <div class="col-md-4 mb-3">
            <label for="{{ $campo }}" class="form-label">{{ ucwords(str_replace('_', ' ', $campo)) }}</label>
            <input type="file" name="{{ $campo }}" id="{{ $campo }}" class="form-control">

            @if(!empty($individuo->$campo))
                <small class="form-text text-muted mt-1">
                    Archivo actual:
                    <a href="{{ asset('storage/' . $individuo->$campo) }}" target="_blank">
                        {{ basename($individuo->$campo) }}
                    </a>
                </small>
            @endif
        </div>
    @endforeach
</div>

