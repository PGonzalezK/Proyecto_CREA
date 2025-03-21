<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class GruposController extends Controller
{
    public function index()
    {
        $grupos = Persona::whereNotNull('codigo_serviu')
            ->where('codigo_serviu', '!=', '')
            ->get()
            ->groupBy('codigo_serviu');

        return view('seccion.grupos', compact('grupos'));
    }
}