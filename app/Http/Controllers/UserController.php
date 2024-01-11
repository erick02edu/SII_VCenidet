<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //Constructor
    public function __construct()
    {
        $this->middleware(['role:Administrador'])->only('index');
        $this->middleware(['role:Administrador'])->only('store');
        $this->middleware(['role:Administrador'])->only('edit','editPassword','update');
        $this->middleware(['role:Administrador'])->only('destroy');
    }
    //Funcion para mostrar todos los usuarios retorna a la vista de Usuarios
    public function index(){
        $Pagination=User::paginate(10);
        $Usuarios=$Pagination->items();
        $roles=Role::all();

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');
        //Obtener lista del personal
        $Personal=app(PersonalController::class)->ObtenerPersonalSinCuenta();
        return Inertia::render('Modulos/Administrador/Usuarios/Usuarios',[
            'usuarios'=>$Usuarios,
            'roles'=>$roles,
            'personal'=>$Personal,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }
    //Funcion para crear un usuario
    public function store(Request $request){
        $user=new User();
        try{
            //Obtener datos
            $user->name=$request->name;
            //$user->email=$request->email;
            $user->password = Hash::make($request->input('password'));
            $user->Estatus='1';

            //Guardar usuario
            $user->save();
            //Obtener id del nuevo usuario
            $newUserId = $user->id;


            //Asignar cuenta al personal
            if($request->input('PersonalAsignar')!=null){
                $requestCuenta=new Request();
                $parametros=[
                    'idPersonal'=>$request->input('PersonalAsignar'),
                    'idCuenta'=>$newUserId
                ];
                $requestCuenta->merge($parametros);
                app(PersonalController::class)->asignarCuenta($requestCuenta);
            }
            //Asignar roles a la cuenta
            return redirect()->route('Roles.asignar', [
                'id' => $newUserId,
                'RolesSeleccionados'=>$request->input('RolesSeleccionados'),
            ]);
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al registrar el usuario');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Users.index');
        }
    }
    //Funcion para redirigir al formulario de edicion
    public function edit(String $id)
    {
        //Obtener el usuario
        $User = User::find($id);
        //Verificar si el usuario existe
        if ($User) {
            return Inertia::render ('Modulos/Administrador/Usuarios/formEditarUsuario',[
                'usuario'=>$User,
            ]);
        }
        else{
            return redirect::route('Users.index');
        }
    }

    public function editPassword(String $id){
        $Usuario=User::find($id);
        if($Usuario){
            return Inertia::render ('Modulos/Administrador/Usuarios/CambiarContraseña',[
                'usuario'=>$Usuario,
            ]);
        }
        else{
            return redirect::route('Users.index');
        }
    }

    public function CambiarContra(Request $request){
        $idUsuario=$request->input('id');
        $Usuario=User::find($idUsuario);

        if($Usuario){
            try{
                $Usuario->password = Hash::make($request->input('password'));
                $Usuario->save();
                Session::flash('mensaje', 'Se ha cambiado la contraseña correctamente');
                Session::flash('TipoMensaje', 'Exitoso');
                return Redirect::route('Users.index');
            }
            catch(Exception $e){
                Session::flash('mensaje', 'Ha ocurrido un error al intentar cambiar la contraseña del usuario');
                Session::flash('TipoMensaje', 'Error');
                return Redirect::route('Users.index');
            }
        }
        else{
            return back();
        }
    }
    //Funcion para actualizar un usuario
    public function update(String $id,Request $request)
    {
        $User=User::find($id);
        //Verifica si el usuario existe
        if($User){
            try{
                $User->update($request->all());
                Session::flash('mensaje', 'Se ha guardado los cambios');
                Session::flash('TipoMensaje', 'Exitoso');
                return redirect::route('Users.index');
            }
            catch(Exception $e){
                Session::flash('mensaje', 'Ha ocurrido un error al intentar actualizar los datos del usuario');
                Session::flash('TipoMensaje', 'Error');
                return redirect::route('Users.index');
            }
        }
        else{
            return redirect::route('Users.index');
        }
    }
    //Funcion para eliminar un usuario
    public function destroy(String $id)
    {
        $User = User::find($id);
        //Verifica si el usuario existe
        if($User){
            try{
                //Eliminar usuario
                $User->delete();
                Session::flash('mensaje', 'Se ha eliminado correctamente al usuario '.$User->name);
                Session::flash('TipoMensaje', 'Exitoso');
                return Redirect::route('Users.index');
            }catch(Exception $e){
                Session::flash('mensaje', 'Ha ocurrido un error al eliminar al usuario '.$User->name);
                Session::flash('TipoMensaje', 'Error');
                return Redirect::route('Users.index');
            }
        }
        else{
            return Redirect::route('Users.index');
        }
    }
    //Función para buscar un usuario
    public function buscarUsuario(Request $request){
        //Recibir parametros
        $Usuario=$request->input('usuario');

        $campo = $request->input('campo');
        //Hacer busqueda
        $result=User::where($campo, 'LIKE', '%'.$Usuario.'%')->get();
        //Devolver resultados
        return $result;
    }

    public function ObtenerUsuarios(){
        $Users=User::all();
        return $Users;
    }

    public function ObtenerUsuarioPorID(String $id){
        $user=User::find($id);
        return $user;
    }

    public function ObtenerUsuariosDisponibles()
    {
        $usuariosDisponibles=User::where('estatus','0')->get();
        return $usuariosDisponibles;
    }
    //Funcion para obtener los permisos de un determinado rol
    public function ObtenerPermisosUsuario(String $idUsuario){
        $user = User::find($idUsuario); //Obtener usuario autenticado
        $permisos = $user->permissions;
        $permisosNames = $permisos->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return $permisosNames;
    }
}
