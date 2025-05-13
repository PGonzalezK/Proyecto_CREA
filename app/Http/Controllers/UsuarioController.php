<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function viewWithPortal($path, $data = [])
    {
        $portal = session('portal', 'crea'); // default a 'crea'
        return view("$portal.$path", $data);
    }

    public function index(Request $request)
    {
        //Sin paginación
        /* $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); */

        //Con paginación
        $usuarios = User::paginate(20);
        return $this->viewWithPortal('usuarios.index', compact('usuarios'));

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name', 'name')->all();
        return $this->viewWithPortal('usuarios.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'id_empresa' => 'required|in:0,1,2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $portal = session('portal', 'crea');
        return redirect()->route("$portal.usuarios.index")->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return $this->viewWithPortal('usuarios.editar', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles' => 'required',
        'id_empresa' => 'required|in:0,1,2'
    ]);

    $input = $request->only(['name', 'email', 'password', 'id_empresa']);

    if (!empty($input['password'])) {
        $input['password'] = Hash::make($input['password']);
    } else {
        $input = Arr::except($input, ['password']);
    }

    $user = User::find($id);
    $user->update($input);

    DB::table('model_has_roles')->where('model_id', $id)->delete();
    $user->assignRole($request->input('roles'));

    $portal = session('portal', 'crea');
    return redirect()->route("$portal.usuarios.index")->with('success', 'Usuario actualizado correctamente.');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return back()->with('error', 'Usuario no encontrado.');
    }

    // Evitar que el admin se elimine a sí mismo
    if (auth()->id() == $user->id) {
        return back()->with('error', 'No puedes eliminar tu propio usuario.');
    }

    // Por ejemplo: evitar eliminar usuarios con rol "SuperAdmin"
    if ($user->hasRole('SuperAdmin')) {
        return back()->with('error', 'No se puede eliminar un SuperAdmin.');
    }

    $user->delete();

    $portal = session('portal', 'crea');
    return redirect()->route("$portal.usuarios.index")->with('success', 'Usuario eliminado correctamente.');
}


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Solo el admin puede cambiar el logo
        if ($request->hasFile('logo')) {
            if (!$user->hasRole('admin')) {
                abort(403, 'No autorizado para cambiar el logo.');
            }

            $portal = session('portal', 'crea'); // detectar portal actual
            $logo = $request->file('logo');
            $logoName = "logo-$portal.png"; // distinto logo por portal

            $logo->move(public_path('img'), $logoName);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $portal = session('portal', 'crea');
        return redirect("/$portal/home")->with('success', 'Perfil actualizado correctamente');
    }

    public function cambiarContrasena(Request $request)
{
    $request->validate([
        'password_current' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->password_current, $user->password)) {
        return back()->withErrors(['password_current' => 'La contraseña actual no es correcta.']);
    }

    $user->update([
        'password' => Hash::make($request->password)
    ]);

    $portal = session('portal', 'crea');
    return redirect("/$portal/home")->with('success', 'Contraseña actualizada correctamente');
}

}
