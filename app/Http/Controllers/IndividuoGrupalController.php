<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individuo;

class IndividuoGrupalController extends Controller
{
    public function index()
    {
        $grupales = Individuo::whereNotNull('codigo_serviu')
            ->where('codigo_serviu', '!=', '')
            ->get()
            ->groupBy('codigo_serviu');

        return view('individuos.grupales', compact('grupales'));
    }
}
