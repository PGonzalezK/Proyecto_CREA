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
        $portal = session('portal', 'crea');
        $empresaId = $portal === 'crea' ? 1 : 2; // admin también se filtra por portal
        $search = $request->input('search');

        $query = Individuo::whereNotNull('codigo_serviu')
            ->where('codigo_serviu', '!=', '')
            ->where('id_empresa', $empresaId);

        if ($search) {
            $query->where('codigo_serviu', 'like', "%{$search}%");
        }

        $individuos = $query->orderBy('codigo_serviu')->get()->groupBy('codigo_serviu');

        // Paginación manual
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

        return view("$portal.individuos.tecnica.index", [
            'paginados' => $paginados,
            'search' => $search
        ]);
    }

    public function show($codigo_serviu)
    {
        $portal = session('portal', 'crea');
        $empresaId = $portal === 'crea' ? 1 : 2;

        $individuos = Individuo::where('codigo_serviu', $codigo_serviu)
            ->where('id_empresa', $empresaId)
            ->get();

        if ($individuos->isEmpty()) {
            return redirect()->route("$portal.tecnica.index")->with('error', 'No se encontraron individuos con ese código SERVIU.');
        }

        return view("$portal.individuos.tecnica.show", compact('codigo_serviu', 'individuos'));
    }

    public function upload(Request $request, $codigo_serviu)
    {
        $request->validate([
            'archivos.*' => 'required|file|max:10240',
            'carpeta' => 'required|string'
        ]);

        $portal = session('portal', 'crea');
        $carpeta = $request->input('carpeta');
        $ruta = "$portal/tecnica/$codigo_serviu/$carpeta";

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

        $portal = session('portal', 'crea');
        $carpetaPadre = $request->input('carpeta_padre', '');
        $nuevaCarpeta = trim($request->input('nueva_carpeta'));

        $rutaCompleta = storage_path("app/public/$portal/tecnica/$codigo_serviu/" . ($carpetaPadre ? "$carpetaPadre/" : '') . $nuevaCarpeta);

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

        $portal = session('portal', 'crea');
        $carpetaRelativa = $request->input('carpeta');
        $rutaCompleta = storage_path("app/public/$portal/tecnica/$codigo_serviu/$carpetaRelativa");

        if (File::exists($rutaCompleta)) {
            File::deleteDirectory($rutaCompleta);
            return back()->with('success', 'Carpeta eliminada correctamente.');
        }

        return back()->with('error', 'La carpeta no existe o ya fue eliminada.');
    }

    public function eliminarArchivo(Request $request, $codigo_serviu)
    {
        $request->validate([
            'archivo' => 'required|string',
        ]);

        $portal = session('portal', 'crea');
        $archivoRelativo = $request->input('archivo');
        $rutaCompleta = storage_path("app/public/$portal/tecnica/$codigo_serviu/$archivoRelativo");

        if (File::exists($rutaCompleta)) {
            File::delete($rutaCompleta);
            return back()->with('success', 'Archivo eliminado correctamente.');
        }

        return back()->with('error', 'El archivo no existe o ya fue eliminado.');
    }
}
