@extends('edifica/layouts.app')

@section('edifica/content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Área Técnica - Código SERVIU: {{ $codigo_serviu }}</h3>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Listado de Individuos:</h5>
                <ul class="list-group">
                    @foreach($individuos as $individuo)
                    <li class="list-group-item">
                        {{ $individuo->nombre }} {{ $individuo->apellido }} - RUT: {{ $individuo->rut }}
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Carpetas Técnicas</h5>

                @php
                $portal = session('portal', 'crea');

                function mostrarCarpetasRecursivas($path, $codigo_serviu, $relativa, &$carpetaIdCounter = 0, $portal)
                {
                $carpetas = \File::directories($path);
                $archivos = \File::files($path);

                $nombre = basename($path);
                $id = 'carpeta-' . $carpetaIdCounter++;

                echo "<div class='carpeta-container'>";
                    echo "<span class='toggle-btn' onclick=\"toggleFolder('$id')\">
                        <span id='icon-$id'>▶</span> 📁 $nombre
                    </span>";
                    echo "<div class='contenido-carpeta' id='$id' style='display: none;'>";

                        // Formulario subir archivos
                        echo "
                        <form action='" . route('edifica.tecnica.upload', $codigo_serviu) . "' method='POST' enctype='multipart/form-data' class='mt-2 mb-2'>
                " . csrf_field() . "
                <input type='hidden' name='carpeta' value='$relativa'>
                <div class='input-group'>
                    <input type='file' name='archivos[]' class='form-control' multiple required>
                    <button type='submit' class='btn btn-sm btn-success'>Subir</button>
                </div>
            </form>" ;

                            // Formulario crear subcarpeta
                            echo "
            <form action='" . route('edifica.tecnica.crearCarpeta', $codigo_serviu) . "' method='POST' class='mb-3'>
                " . csrf_field() . "
                <input type='hidden' name='carpeta_padre' value='$relativa'>
                <div class='input-group'>
                    <input type='text' name='nueva_carpeta' class='form-control' placeholder='Nueva subcarpeta' required>
                    <button type='submit' class='btn btn-sm btn-outline-secondary'>Crear carpeta</button>
                </div>
            </form>" ;

                            // Botón eliminar carpeta
                            if ($relativa !=='' ) {
                            echo "
                <form action='" . route('edifica.tecnica.eliminarCarpeta', $codigo_serviu) . "' method='POST' onsubmit='return confirm(\" ¿Estás seguro que deseas eliminar esta carpeta y todo su contenido?\")' class='mb-3'>
                            " . csrf_field() . method_field('DELETE') . "
                            <input type='hidden' name='carpeta' value='$relativa'>
                            <button type='submit' class='btn btn-sm btn-danger'>Eliminar carpeta</button>
                        </form>";
                        }

                        // Archivos
                        echo "<ul>";
                            foreach ($archivos as $archivo) {
                            $nombreArchivo = $archivo->getFilename();
                            $relativaLimpiada = ltrim($relativa, '/');
                            $rutaWeb = asset("storage/$portal/tecnica/$codigo_serviu" . ($relativaLimpiada ? "/$relativaLimpiada" : '') . "/$nombreArchivo");
                            echo "<li>
                                📄 <a href='$rutaWeb' target='_blank'>$nombreArchivo</a>
                                <form action='" . route('edifica.tecnica.eliminarArchivo', $codigo_serviu) . "' method='POST' style='display:inline-block; margin-left: 10px;' onsubmit='return confirm(\" ¿Seguro que deseas eliminar este archivo?\")'>
                                    " . csrf_field() . method_field('DELETE') . "
                                    <input type='hidden' name='archivo' value='$relativaLimpiada/$nombreArchivo'>
                                    <button class='btn btn-sm btn-danger'>Eliminar</button>
                                </form>
                            </li>";
                            }
                            echo "</ul>";

                        // Subcarpetas (recursividad)
                        foreach ($carpetas as $subcarpeta) {
                        $subrelativa = $relativa . '/' . basename($subcarpeta);
                        mostrarCarpetasRecursivas($subcarpeta, $codigo_serviu, $subrelativa, $carpetaIdCounter, $portal);
                        }
                        echo "
                    </div>
                </div>"; // Cierre contenido y contenedor
                }
                @endphp
                @php
                $basePath = storage_path("app/public/$portal/tecnica/$codigo_serviu");
                if (!\File::exists($basePath)) {
                \File::makeDirectory($basePath, 0775, true);
                }
                $contador = 0;
                mostrarCarpetasRecursivas($basePath, $codigo_serviu, '', $contador, $portal);
                @endphp
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('edifica.tecnica.index') }}" class="btn btn-secondary">← Volver</a>
        </div>
    </div>
</section>
@endsection