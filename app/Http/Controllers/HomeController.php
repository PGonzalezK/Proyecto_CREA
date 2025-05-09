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
    public function index()
    {
        $hoy = Carbon::today();

        // Carnets por vencer en los próximos 30 días
        $individuosPorVencer = Individuo::whereNotNull('fecha_carnet')
            ->whereBetween('fecha_carnet', [$hoy, $hoy->copy()->addDays(30)])
            ->orderBy('fecha_carnet')
            ->get();

        // Carnets ya vencidos
        $individuosVencidos = Individuo::whereNotNull('fecha_carnet')
            ->where('fecha_carnet', '<', $hoy)
            ->orderBy('fecha_carnet')
            ->get();

        return view('home', compact('individuosPorVencer', 'individuosVencidos'));
    }
}
