<?php

namespace App\Http\Controllers;

use App\Models\Individuo;
use Illuminate\Http\Request;

class IndividuoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-individuo', ['only' => ['index']]);
        $this->middleware('permission:crear-individuo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-individuo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-individuo', ['only' => ['destroy']]);
        $this->middleware('permission:mostrar-individuo', ['only' => ['show']]);
    }

    public function index()
    {
        $individuos = \App\Models\Individuo::paginate(20);
        return view('individuos.index', compact('individuos'));
    }

    public function create()
    {
        return view('individuos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|max:255',
            'codigo_serviu' => 'nullable|string|max:255',
            'fecha_carnet' => 'nullable|date',
        ]);

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

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'file|mimes:pdf,jpg,jpeg,png|max:2048'
                ]);
                $data[$field] = $request->file($field)->store('documentos', 'public');
            }
        }

        Individuo::create($data);

        return redirect()->route('individuos.index')->with('success', 'Individuo creado correctamente.');
    }

    public function show(Individuo $individuo)
    {
        return view('individuos.show', compact('individuo'));
    }

    public function edit(Individuo $individuo)
    {
        return view('individuos.edit', compact('individuo'));
    }

    public function update(Request $request, Individuo $individuo)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|max:255',
            'codigo_serviu' => 'nullable|string|max:255',
            'fecha_carnet' => 'nullable|date',
        ]);

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

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'file|mimes:pdf,jpg,jpeg,png|max:2048'
                ]);
                $data[$field] = $request->file($field)->store('documentos', 'public');
            }
        }

        $individuo->update($data);

        return redirect()->route('individuos.index')->with('success', 'Individuo actualizado correctamente.');
    }

    public function destroy(Individuo $individuo)
    {
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

        foreach ($fileFields as $field) {
            if ($individuo->$field && \Storage::disk('public')->exists($individuo->$field)) {
                \Storage::disk('public')->delete($individuo->$field);
            }
        }

        $individuo->delete();

        return redirect()->route('individuos.index')->with('success', 'Individuo eliminado correctamente.');
    }
}
