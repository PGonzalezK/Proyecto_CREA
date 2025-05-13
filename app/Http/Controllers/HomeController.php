<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individuo;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function indexCrea()
    {
        $hoy = Carbon::now();
        $empresa = auth()->user()->id_empresa;
        $individuosPorVencer = Individuo::whereNotNull('fecha_carnet')
        ->whereBetween('fecha_carnet', [$hoy, $hoy->copy()->addDays(30)])
        ->when($empresa = 1, fn($q) => $q->where('id_empresa', $empresa))
        ->get();
    
    $individuosVencidos = Individuo::whereNotNull('fecha_carnet')
        ->where('fecha_carnet', '<', $hoy)
        ->when($empresa = 1, fn($q) => $q->where('id_empresa', $empresa))
        ->get();

        return view('crea.home', compact('individuosPorVencer', 'individuosVencidos'));
    }

    public function indexEdifica()
    {
        $hoy = now();
        $empresa = auth()->user()->id_empresa;
    
        $individuosPorVencer = Individuo::whereNotNull('fecha_carnet')
            ->whereBetween('fecha_carnet', [$hoy, $hoy->copy()->addDays(30)])
            ->when($empresa = 2, fn($q) => $q->where('id_empresa', $empresa))
            ->get();
    
        $individuosVencidos = Individuo::whereNotNull('fecha_carnet')
            ->where('fecha_carnet', '<', $hoy)
            ->when($empresa = 2, fn($q) => $q->where('id_empresa', $empresa))
            ->get();
    
        return view('edifica.home', compact('individuosPorVencer', 'individuosVencidos'));
    }
    
}
