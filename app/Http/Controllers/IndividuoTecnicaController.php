<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individuo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class IndividuoTecnicaController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // Filtrar individuos por código_serviu si hay búsqueda
    $query = Individuo::whereNotNull('codigo_serviu')
        ->where('codigo_serviu', '!=', '');

    if ($search) {
        $query->where('codigo_serviu', 'like', "%{$search}%");
    }

    // Obtener los individuos y agrupar por código_serviu
    $individuos = $query->orderBy('codigo_serviu')->get()->groupBy('codigo_serviu');

    // Paginación manual sobre los grupos
    $perPage = 15;
    $page = $request->input('page', 1);
    $total = $individuos->count();

    $items = $individuos->slice(($page - 1) * $perPage, $perPage)->all();
    $paginados = new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('individuos.tecnica.index', [
        'paginados' => $paginados,
        'search' => $search
    ]);
}


    public function show($codigo_serviu)
    {
        // Obtener todos los individuos con ese código_serviu
        $individuos = Individuo::where('codigo_serviu', $codigo_serviu)->get();

        if ($individuos->isEmpty()) {
            return redirect()->route('tecnica.index')->with('error', 'No se encontraron individuos con ese código SERVIU.');
        }

        return view('individuos.tecnica.show', compact('codigo_serviu', 'individuos'));
    }

    public function upload(Request $request, $codigo_serviu)
    {
        $request->validate([
            'archivos.*' => 'required|file|max:10240',
            'carpeta' => 'required|string'
        ]);

        $carpeta = $request->input('carpeta');
        $ruta = "tecnica/$codigo_serviu/$carpeta";

        foreach ($request->file('archivos') as $archivo) {
            $archivo->storeAs("public/$ruta", $archivo->getClientOriginalName());
        }

        return back()->with('success', 'Archivo(s) subido(s) correctamente.');
    }

    public function crearCarpeta(Request $request, $codigo_serviu)
    {
        $request->validate([
            'nueva_carpeta' => 'required|string',
            'carpeta_padre' => 'nullable|string'
        ]);

        $carpetaPadre = $request->input('carpeta_padre', '');
        $nuevaCarpeta = trim($request->input('nueva_carpeta'));

        $rutaCompleta = storage_path("app/public/tecnica/$codigo_serviu/" . ($carpetaPadre ? "$carpetaPadre/" : '') . $nuevaCarpeta);

        if (!File::exists($rutaCompleta)) {
            File::makeDirectory($rutaCompleta, 0775, true);
            return back()->with('success', 'Carpeta creada correctamente.');
        }

        return back()->with('error', 'La carpeta ya existe.');
    }
    public function eliminarCarpeta(Request $request, $codigo_serviu)
    {
        $request->validate([
            'carpeta' => 'required|string',
        ]);

        $carpetaRelativa = $request->input('carpeta');
        $rutaCompleta = storage_path("app/public/tecnica/$codigo_serviu/$carpetaRelativa");

        if (\File::exists($rutaCompleta)) {
            \File::deleteDirectory($rutaCompleta);
            return back()->with('success', 'Carpeta eliminada correctamente.');
        }

        return back()->with('error', 'La carpeta no existe o ya fue eliminada.');
    }
}
