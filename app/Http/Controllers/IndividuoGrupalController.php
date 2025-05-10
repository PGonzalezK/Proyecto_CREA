<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individuo;

class IndividuoGrupalController extends Controller
{
    public function index()
    {
        $portal = session('portal', 'crea'); // 'crea' o 'edifica'
    
        // Determinar empresa según portal
        $empresaId = $portal === 'crea' ? 1 : 2;
    
        $individuos = \App\Models\Individuo::whereNotNull('codigo_serviu')
            ->where('codigo_serviu', '!=', '')
            ->where('id_empresa', $empresaId) // Aquí se filtra SIEMPRE por empresa según portal
            ->orderBy('codigo_serviu')
            ->get();
    
        $grupales = $individuos->groupBy('codigo_serviu');
    
        return view("$portal.individuos.grupales", compact('grupales'));
    }
    
    
}
