<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }

    private function getPortal()
    {
        return session('portal', 'crea');
    }

    public function index(Request $request)
    {
        $portal = $this->getPortal();
        $roles = Role::with('permissions')->paginate(20);
        return view("$portal.roles.index", compact('roles'));
    }

    public function create()
    {
        $portal = $this->getPortal();

        // Agrupar por última palabra del permiso (ej. 'tecnica' en 'ver-area-tecnica')
        $permission = Permission::get()->groupBy(function ($item) {
            $partes = explode('-', $item->name);
            return end($partes) ?: 'otros';
        });

        return view("$portal.roles.crear", compact('permission'));
    }

    public function store(Request $request)
    {
        $portal = $this->getPortal();

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route("$portal.roles.index")->with('success', 'Rol creado correctamente.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $portal = $this->getPortal();

        $role = Role::findOrFail($id);

        // Agrupar permisos igual que en create()
        $permission = Permission::get()->groupBy(function ($item) {
            $partes = explode('-', $item->name);
            return end($partes) ?: 'otros';
        });

        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view("$portal.roles.editar", compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $portal = $this->getPortal();

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route("$portal.roles.index")->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy($id)
    {
        $portal = $this->getPortal();

        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route("$portal.roles.index")->with('success', 'Rol eliminado correctamente.');
    }
}
