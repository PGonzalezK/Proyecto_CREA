<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    
    

}
