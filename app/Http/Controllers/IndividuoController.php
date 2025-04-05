<?php

namespace App\Http\Controllers;

use App\Models\Individuo;
use Illuminate\Http\Request;

class IndividuoController extends Controller
{
    public function index()
    {
        // Usamos paginación para que funcione $individuos->links() en la vista
        $individuos = \App\Models\Individuo::paginate(20); // Puedes cambiar 5 por el número de registros por página
    
        return view('individuos.index', compact('individuos'));
    }
    
    public function create()
    {
        return view('individuos.create');
    }

    public function store(Request $request)
    {
        // Validación de campos de texto y fecha
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|max:255',
            'codigo_serviu' => 'nullable|string|max:255',
            'fecha_carnet' => 'nullable|date',
        ]);

        // Campos de tipo archivo
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
        // Opcional: eliminar archivos si se desea
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
