<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Http\RedirectResponse;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $personas = Persona::when($busqueda, function ($query, $busqueda) {
            return $query->where(function ($query) use ($busqueda) {
                $query->where('nombre', 'LIKE', "%{$busqueda}%")
                      ->orWhere('apellido', 'LIKE', "%{$busqueda}%")
                      ->orWhere('rut', 'LIKE', "%{$busqueda}%");
            });
        })->get();

        return view('seccion.personas', compact('personas', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|unique:personas,rut',
            'fecha_carnet' => 'required|date', // Validación de fecha
            'carnet_identidad' => 'required|file|mimes:pdf,jpg,png', // Validar archivo del carnet

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

        $datos = $request->only(['nombre', 'apellido', 'rut', 'fecha_carnet']);

        // Guardar archivo de carnet de identidad
        if ($request->hasFile('carnet_identidad')) {
            $datos['carnet_identidad'] = $request->file('carnet_identidad')->store('documentos', 'public');
        }

        // Manejo de otros archivos
        foreach ([
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

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        return view('personas.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rut' => 'required|string|unique:personas,rut,' . $persona->id,
            'fecha_carnet' => 'required|date',
            'carnet_identidad' => 'file|mimes:pdf,jpg,png', // Validar archivo del carnet
        ]);

        $datos = $request->only(['nombre', 'apellido', 'rut', 'fecha_carnet']);

        // Si se sube un nuevo carnet, lo actualiza
        if ($request->hasFile('carnet_identidad')) {
            $datos['carnet_identidad'] = $request->file('carnet_identidad')->store('documentos', 'public');
        }

        // Manejo de otros archivos
        foreach ([
            'carta_compromiso', 'contrato_construccion', 'post_subsidio',
            'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom', 'prohibicion_1',
            'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia', 'boleta_garantia_constructora'
        ] as $doc) {
            if ($request->hasFile($doc)) {
                $datos[$doc] = $request->file($doc)->store('documentos', 'public');
            }
        }

        $persona->update($datos);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona): RedirectResponse
    {
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente.');
    }
}
