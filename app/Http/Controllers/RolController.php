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

    public function index(Request $request)
    {
        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get()->groupBy(function ($item) {
            return explode('-', $item->name)[1] ?? 'otros';
        });

        return view('roles.crear', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);

        $permission = Permission::get()->groupBy(function ($item) {
            return explode('-', $item->name)[1] ?? 'otros';
        });

        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.editar', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Solo permitir subir logo si el usuario tiene el rol 'admin'
        if ($request->hasFile('logo') && $user->hasRole('admin')) {
            $logo = $request->file('logo');
            $logo->move(public_path('img'), 'logo.png');
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index');
    }
}
