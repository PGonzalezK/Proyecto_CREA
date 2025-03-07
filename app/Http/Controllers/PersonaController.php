<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Http\RedirectResponse;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
    
        $personas = Persona::when($busqueda, function ($query, $busqueda) {
            return $query->where(function ($query) use ($busqueda) {
                $query->where('nombre', 'LIKE', "%{$busqueda}%")
                      ->orWhere('apellido', 'LIKE', '%'.$busqueda.'%')
                      -> orWhere('rut', 'LIKE', '%'.$busqueda.'%');
            });
        })->get();
    
        return view('seccion.personas', compact('personas', 'busqueda'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    return view('personas.create');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|unique:personas,rut',
    
            // validación archivos
            'carta_compromiso' => 'required|file|mimes:pdf,jpg,png',
            'contrato_construccion' => 'required|file|mimes:pdf,jpg,png',
            'post_subsidio' => 'file|mimes:pdf,jpg,png',
            'te1' => 'file|mimes:pdf,jpg,png',
            'tc6' => 'file|mimes:pdf,jpg,png',
            'reduccion' => 'file|mimes:pdf,jpg,png',
            'permiso' => 'file|mimes:pdf,jpg,png',
            'recepcion_dom' => 'file|mimes:pdf,jpg,png',
            'prohibicion_1' => 'file|mimes:pdf,jpg,png',
            'prohibicion_2' => 'file|mimes:pdf,jpg,png',
            'autoricese' => 'file|mimes:pdf,jpg,png',
            'boleta_garantia_asistencia' => 'file|mimes:pdf,jpg,png',
            'boleta_garantia_constructora' => 'file|mimes:pdf,jpg,png',
        ]);
    
        $datos = $request->only(['nombre', 'apellido', 'rut']);
    
        // Manejo de archivos
        foreach([
            'carta_compromiso', 'contrato_construccion', 'post_subsidio',
            'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1',
            'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'
        ] as $doc) {
            if ($request->hasFile($doc)) {
                $datos[$doc] = $request->file($doc)->store('documentos', 'public');
            }
        }
    
        Persona::create($datos);
    
        return redirect()->route('personas.index')->with('success', 'Persona registrada correctamente.');

    }

    public function show(Persona $persona)
    {
        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|unique:personas,rut,' . $persona->id,
        ]);

        $persona->update($request->all());

        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy(Persona $persona): RedirectResponse
    {
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente.');
    }

}
