<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:Agregar Roles')->only('store');
        $this->middleware('can:Ver Roles')->only('index');
        $this->middleware('can:Editar Roles')->only('edit','update');
        //$this->middleware('can:Borrar Roles')->only('destroy');

    }

    public function index(){
        $Roles=Role::all();
        return Inertia::render('Roles',['roles'=>$Roles]);
    }


    public function store(Request $request){
        $Role=new Role();
        $Role->name=$request->name;
        $Role->guard_name='web';
        $Role->save();
        $newRoleId = $Role->id;
        return redirect()->route('Permisos.asignar', ['id' => $newRoleId, 'PermisosSeleccionados'=>$request->input('PermisosSeleccionados')]);
    }

    //Funcion para redirigir al formulario de edicion
    public function edit(String $id)
    {
        $Role = Role::find($id);
        return Inertia::render ('formEditarRol',[
            'rol'=>$Role,
        ]);
    }

    //Funcion para actualizar un usuario
    public function update(String $id,Request $request)
    {
        $Role=Role::find($id);
        $Role->update($request->all());
        return redirect::route('Roles.index');
    }


    public function destroy(String $id)
    {
        $Role = Role::find($id);
        $Role->delete();
        return Redirect::route('Roles.index');
    }


    //Funcion para obtener rol del usuario authenticadp
    public function ObtenerRolUsuarioAutenticado()
    {
        $user=Auth::user(); //obtener usuario autenticado
        $roles = $user->roles; // Esto obtendrá una colección de roles asignados al usuario

        $roleNames = $roles->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaRoles'=>$roleNames]);
    }

    //Funcion para obtener rol de un usuario por medio de su id
    public function ObtenerRolUsuario(String $id)
    {
        $User = User::find($id); //obtener usuario autenticado
        $roles = $User->roles; // Esto obtendrá una colección de roles asignados al usuario

        $roleNames = $roles->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaRolesUsuario'=>$roleNames]);
    }


    //Funcion para obtener todos los roles existentes
    public function GetRoles()
    {
        $Role=Role::all();
        return response()->json(['ListaRoles'=>$Role]);
    }

    //Funcion para redirigir al formulario de edicion del Role
    public function EditRole(String $id)
    {
        $User = User::find($id);
        return Inertia::render ('AsignarRol',[
            'usuario'=>$User,
        ]);
    }

    public function AsignarRol(Request $request){

        $id=$request->input('id');
        $User = User::find($id);
        $User->roles()->sync($request->input('RolesSeleccionados'));

        //return redirect()->route('Users.editRole',$id)->with('Info','Se asigno los roles correctamente');

        return back()->with([$id]);

    }

    public function can(Request $request){

        //Recuperamos los datos
        $id = $request->input('userID');
        $Rol = $request->input('Rol');

        //Obtenemos el usuario por su ID
        $User = User::find($id);

        //Obtenemos lista de roles
        $roles = $User->roles; // Esto obtendrá una colección de roles asignados al usuario
        $roleNames = $roles->pluck('name')->toArray();//Obtener solo un array con el nombre de los roles
        return response()->json(['roles'=>$roleNames]);

    }


    public function buscarRol(Request $request){
        $rol=$request->input('Rol');

        $campo = $request->input('campo');

        $result=Role::where($campo, 'LIKE', '%'.$rol.'%')->get();

        return $result;
    }



}
