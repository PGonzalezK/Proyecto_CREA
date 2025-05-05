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
            'carta_compromiso' => 'nullable|file|mimes:pdf,doc,docx',
            'contrato_construccion' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Carpeta de destino: Antecedentes Grupales/{codigo}
        $folder = 'Antecedentes Grupales/' . $codigo;

        if ($request->hasFile('carta_compromiso')) {
            $request->file('carta_compromiso')->storeAs($folder, 'Carta_de_Compromiso.pdf', 'public');
        }

        if ($request->hasFile('contrato_construccion')) {
            $request->file('contrato_construccion')->storeAs($folder, 'Contrato_de_Construccion.pdf', 'public');
        }

        return back()->with('success', 'Documentos subidos correctamente.');
    }

    public function eliminarArchivo($codigo, $tipo)
    {
        if (!in_array($tipo, ['Carta_de_Compromiso', 'Contrato_de_Construccion'])) {
            abort(400, 'Tipo de archivo no válido');
        }

        $ruta = "Antecedentes Grupales/{$codigo}/{$tipo}.pdf";

        if (Storage::disk('public')->exists($ruta)) {
            Storage::disk('public')->delete($ruta);
            return back()->with('success', str_replace('_', ' ', $tipo) . ' eliminado correctamente.');
        }

        return back()->with('error', "$tipo no encontrado.");
    }
}
