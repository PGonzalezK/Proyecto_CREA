<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now();
        $fechaLimite = $hoy->addDays(30); // Carnets que vencen en los próximos 30 días

        $personas = Persona::whereNotNull('fecha_carnet')
                            ->where('fecha_carnet', '<=', $fechaLimite)
                            ->orderBy('fecha_carnet', 'asc')
                            ->get();

        return view('inicio', compact('personas'));
    }
}
