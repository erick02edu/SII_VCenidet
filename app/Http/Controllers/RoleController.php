<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //Constructor
    public function __construct()
    {
        $this->middleware(['role:Administrador'])->only('index');
        $this->middleware(['role:Administrador'])->only('AsignarRol','EditRole');
        $this->middleware(['role:Administrador'])->only('store');
        $this->middleware(['role:Administrador'])->only('edit','update');
        $this->middleware(['role:Administrador'])->only('destroy');
    }

    public function index(){

        $Pagination=Role::paginate(10);

        $Roles=$Pagination->items();
        $Permisos=app(PermissionController::class)->ObtenerPermisos();
        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/Administrador/RolesPermisos/Roles',[
            'roles'=>$Roles,
            'Permisos'=>$Permisos,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }
    //Funcion para registrar un nuevo tipo de usuario(Rol)
    public function store(Request $request){
        $Role=new Role();
        $Role->name=$request->name;
        $Role->guard_name='web';
        $Role->save();
        $newRoleId = $Role->id;
        return redirect()->route('Permisos.asignar', ['id' => $newRoleId, 'PermisosSeleccionados'=>$request->input('PermisosSeleccionados')]);
    }
    //Funcion para redirigir al formulario de edicion de un tipo de usuario(Rol)
    public function edit(String $id)
    {
        $Role = Role::find($id);
        if($Role){
            return Inertia::render ('Modulos/Administrador/RolesPermisos/formEditarRol',[
                'rol'=>$Role,
            ]);
        }
        else{
            return back();
        }
    }
    //Funcion para actualizar un usuario
    public function update(String $id,Request $request)
    {
        $Role=Role::find($id);
        //Verificar si existe el rol
        if($Role){
            try{
                $Role->update($request->all());
                Session::flash('mensaje', 'Cambio realizado exitosamente');
                Session::flash('TipoMensaje', 'Exitoso');
                return redirect::route('Roles.index');
            }
            catch(Exception $e){
                Session::flash('mensaje', 'No se pudo realizar el cambio');
                Session::flash('TipoMensaje', 'Error');
                return redirect::route('Roles.index');
            }
        }
        else{
            return redirect::route('Roles.index');
        }
    }

    //Funcion para eliminar un usuario
    public function destroy(String $id)
    {
        $Role = Role::find($id);
        //Verificar si existe el rol
        if($Role){
            try{
                $Role->delete();
                Session::flash('mensaje', 'Se ha eliminado correctamente el rol');
                Session::flash('TipoMensaje', 'Exitoso');
                return Redirect::route('Roles.index');
            }
            catch(Exception $e){
                Session::flash('mensaje', 'No se pudo eliminar el rol');
                Session::flash('TipoMensaje', 'Error');
                return Redirect::route('Roles.index');
            }
        }
        else{
            return redirect::route('Roles.index');
        }
    }

    //Funcion para obtener la lista de roles
    public function ObtenerRoles(){
        $Roles=Role::all();
        return $Roles;
    }

    //Funcion para devolver todos los usuarios de un determinado rol
    public function ObtenerUsuariosDeUnRol(String $IdRol){
        $Rol=Role::find($IdRol);
        $ListaUsuarios=User::role($Rol->name)->get();
        $ListaUsuarios = $ListaUsuarios->map(function ($user) {
            return $user->toArray();
        })->all();
        return $ListaUsuarios;
    }

    //Funcion para obtener rol del usuario authenticado
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

    //Funcion para redirigir al formulario de edicion del Role
    public function EditRole(String $id)
    {
        $User = User::find($id);
        $roles = $User->getRoleNames();
        $roleIds = $User->roles->pluck('id')->all();
        $ListaRoles=Role::all();
        return Inertia::render ('Modulos/Administrador/RolesPermisos/AsignarRol',[
            'usuario'=>$User,
            'RolesActuales'=>$roles,
            'ListaRolesTotal'=>$ListaRoles,
            'rolesMarcar'=>$roleIds
        ]);
    }
    //Funcion para asignar un rol a un usuario
    public function AsignarRol(Request $request){
        $id=$request->input('id');
        $User = User::find($id);
        //Verificar si existe el usuario
        if($User){
            $User->roles()->sync($request->input('RolesSeleccionados'));
            Session::flash('mensaje', 'Usuario registrado correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return back()->with([$id]);
        }
        else{
            return redirect::route('Roles.index');
        }
    }
    //Funcion para buscar un rol
    public function buscarRol(Request $request){
        $rol=$request->input('Rol'); //Obtener cadena envianda
        $campo = $request->input('campo'); //Obtener el campo por el que se realizara la busqueda
        $result=Role::where($campo, 'LIKE', '%'.$rol.'%')->get();
        return $result;
    }
}
