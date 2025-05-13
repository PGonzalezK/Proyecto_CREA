<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiuController extends Controller
{

    public function upload(Request $request, $codigo)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);
    
        $portal = session('portal', 'crea');
        $folder = "$portal/Antecedentes Grupales/$codigo";
    
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $nombreOriginal = $file->getClientOriginalName();
            $file->storeAs("public/$folder", $nombreOriginal);
        }
    
        return back()->with('success', 'Archivo subido correctamente.');
    }
    

    public function eliminarArchivo($codigo, $tipo)
    {
        $portal = session('portal', 'crea');
        $ruta = "$portal/Antecedentes Grupales/{$codigo}/{$tipo}.pdf";

        if (Storage::disk('public')->exists($ruta)) {
            Storage::disk('public')->delete($ruta);
            return back()->with('success', str_replace('_', ' ', $tipo) . ' eliminado correctamente.');
        }

        return back()->with('error', "$tipo no encontrado.");
    }
}
