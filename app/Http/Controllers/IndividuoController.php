<?php

namespace App\Http\Controllers;

use App\Models\Individuo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndividuoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-individuo', ['only' => ['index']]);
        $this->middleware('permission:crear-individuo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-individuo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-individuo', ['only' => ['destroy']]);
        $this->middleware('permission:mostrar-individuo', ['only' => ['show']]);
    }

    private function getPortal()
    {
        return session('portal', 'crea');
    }

    public function index()
    {
        $portal = $this->getPortal();
        $individuos = Individuo::where('id_empresa', $portal === 'crea' ? 1 : 2)->paginate(20);
        return view("$portal.individuos.index", compact('individuos'));
    }

    public function create()
    {
        $portal = $this->getPortal();
        return view("$portal.individuos.create");
    }

    public function store(Request $request)
    {
        $portal = $this->getPortal();

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|max:255',
            'codigo_serviu' => 'nullable|string|max:255',
            'fecha_carnet' => 'nullable|date',
        ]);

        $fileFields = [
            'carnet_identidad',
            'carta_compromiso',
            'contrato_construccion',
            'anteproyecto',
            'apruebase',
            'cert_electrico',
            'cert_sitio_eriazo',
            'cert_avaluo_detallado',
            'cert_informaciones_p',
            'comite_agua',
            'escritura',
            'estudio',
            'titulo',
            'registro_social_hogares',
            'te1',
            'tc6',
            'reduccion',
            'permiso',
            'recepcion_dom',
            'prohibicion_1',
            'prohibicion_2',
            'autoricese'
        ];

        $nombreCompleto = str_replace(' ', '_', $data['nombre'] . '_' . $data['apellido']);
        $folder = "$portal/Individuos/$nombreCompleto";

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'file|mimes:pdf,jpg,jpeg,png|max:2048'
                ]);

                $archivo = $request->file($field);
                $nombreOriginal = $archivo->getClientOriginalName();
                $rutaAlmacenamiento = "$folder/$nombreOriginal";

                $archivo->storeAs("public/$folder", $nombreOriginal);
                $data[$field] = $rutaAlmacenamiento;
            }
        }

        $data['id_empresa'] = $portal === 'crea' ? 1 : 2;
        Individuo::create($data);

        return redirect()->route("$portal.individuos.index")->with('success', 'Individuo creado correctamente.');
    }


    public function show(Individuo $individuo)
    {
        $portal = $this->getPortal();
        return view("$portal.individuos.show", compact('individuo'));
    }

    public function edit(Individuo $individuo)
    {
        $portal = $this->getPortal();
        return view("$portal.individuos.edit", compact('individuo'));
    }

    public function update(Request $request, Individuo $individuo)
    {
        $portal = $this->getPortal();

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|max:255',
            'codigo_serviu' => 'nullable|string|max:255',
            'fecha_carnet' => 'nullable|date',
        ]);

        $fileFields = [
            'carnet_identidad',
            'carta_compromiso',
            'contrato_construccion',
            'anteproyecto',
            'apruebase',
            'cert_electrico',
            'cert_sitio_eriazo',
            'cert_avaluo_detallado',
            'cert_informaciones_p',
            'comite_agua',
            'escritura',
            'estudio',
            'titulo',
            'registro_social_hogares',
            'te1',
            'tc6',
            'reduccion',
            'permiso',
            'recepcion_dom',
            'prohibicion_1',
            'prohibicion_2',
            'autoricese'
        ];

        $nombreCompleto = str_replace(' ', '_', $individuo->nombre . '_' . $individuo->apellido);
        $folder = "$portal/Individuos/$nombreCompleto";

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'file|mimes:pdf,jpg,jpeg,png|max:2048'
                ]);

                $archivo = $request->file($field);
                $nombreOriginal = $archivo->getClientOriginalName();
                $rutaAlmacenamiento = "$folder/$nombreOriginal";

                $archivo->storeAs("public/$folder", $nombreOriginal);
                $data[$field] = $rutaAlmacenamiento;
            }
        }

        $individuo->update($data);

        return redirect()->route("$portal.individuos.index")->with('success', 'Individuo actualizado correctamente.');
    }


    public function destroy(Individuo $individuo)
    {
        $portal = $this->getPortal();

        $fileFields = [
            'carnet_identidad',
            'carta_compromiso',
            'contrato_construccion',
            'anteproyecto',
            'apruebase',
            'cert_electrico',
            'cert_sitio_eriazo',
            'cert_avaluo_detallado',
            'cert_informaciones_p',
            'comite_agua',
            'escritura',
            'estudio',
            'titulo',
            'registro_social_hogares',
            'te1',
            'tc6',
            'reduccion',
            'permiso',
            'recepcion_dom',
            'prohibicion_1',
            'prohibicion_2',
            'autoricese'
        ];

        foreach ($fileFields as $field) {
            if ($individuo->$field && Storage::disk('public')->exists($individuo->$field)) {
                Storage::disk('public')->delete($individuo->$field);
            }
        }

        $individuo->delete();

        return redirect()->route("$portal.individuos.index")->with('success', 'Individuo eliminado correctamente.');
    }

    public function eliminarArchivo($portal, $id, $archivo)
    {
        $individuo = Individuo::findOrFail($id);
        $nombreCompleto = str_replace(' ', '_', $individuo->nombre . '_' . $individuo->apellido);
        $ruta = "$portal/Individuos/$nombreCompleto/$archivo";

        if (Storage::disk('public')->exists($ruta)) {
            Storage::disk('public')->delete($ruta);
            return back()->with('success', 'Archivo eliminado correctamente.');
        }

        return back()->with('error', 'El archivo no existe.');
    }
}
