<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individuo;

class IndividuoGrupalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        $query = \App\Models\Individuo::whereNotNull('codigo_serviu')
            ->where('codigo_serviu', '!=', '');
    
        // Solo filtra por empresa si no es admin
        if ($user->id_empresa != 0) {
            $query->where('id_empresa', $user->id_empresa);
        }
    
        $individuos = $query->orderBy('codigo_serviu')->get();
    
        if ($individuos->isEmpty()) {
            dd('NO LLEGA NINGÚN INDIVIDUO CON CODIGO SERVIU Y id_empresa = ' . $user->id_empresa);
        }
    
        $grupales = $individuos->groupBy('codigo_serviu');
    
        return view('crea.individuos.grupales', compact('grupales'));
    }
    
     
}
