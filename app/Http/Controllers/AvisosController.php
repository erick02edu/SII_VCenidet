<?php

namespace App\Http\Controllers;

use App\Models\Avisos;
use App\Models\Avisos_Usuarios;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


class AvisosController extends Controller
{
    public function index(){

        $Pagination=Avisos::paginate(10);
        $Avisos=$Pagination->items();

        $ListaUsuarios=app(UserController::class)->ObtenerUsuarios();

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');


        return Inertia::render('Modulos/RH/Avisos/Avisos',[
            'avisos'=>$Avisos,
            'Paginator'=>$Pagination,
            'usuarios'=>$ListaUsuarios,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);

    }

    public function create(){

        $ListaUsuarios=app(UserController::class)->ObtenerUsuarios();
        $ListaRoles=app(RoleController::class)->ObtenerRoles();
        return Inertia::render('Modulos/RH/Avisos/CrearAviso',[
            'usuarios'=>$ListaUsuarios,
            'roles'=>$ListaRoles
        ]);
    }

    public function store(Request $request){

            $Aviso=new Avisos();

        // try{

            $Aviso->Titulo=$request->Titulo;
            $Aviso->Descripcion=$request->Descripcion;

            date_default_timezone_set('America/Mexico_City');//Zona horaria Mexico
            $Aviso->FechaPublicacion=date("Y-m-d");
            $Aviso->save();


            $usuariosEnviar=$request->UsuariosSeleccionados;



            if(count($request->RolesSeleccionados)>0){

                foreach($request->RolesSeleccionados as $Rol){

                    $ListaUsuarios=app(RoleController::class)->ObtenerUsuariosDeUnRol($Rol['id']);

                    // Convertir los arrays a colecciones
                    $usuariosEnviar = collect($usuariosEnviar);
                    $ListaUsuarios = collect($ListaUsuarios);


                    // Combinar las colecciones sin duplicados basados en la clave "id"
                    $usuariosEnviar = $usuariosEnviar->concat($ListaUsuarios)->unique('id');

                    // Convertir la colección combinada de nuevo a un array
                    $usuariosEnviar = $usuariosEnviar->values()->all();

                }

            }


            $requestEnviar=new Request();
            $parametros=['ListaUsuario'=>$usuariosEnviar,'Aviso'=>$Aviso];
            $requestEnviar->merge($parametros);


            app(AvisosUsuarioController::class)->store($requestEnviar);

            Session::flash('mensaje', 'Se ha publicado el aviso correctamente');
            Session::flash('TipoMensaje', 'Exitoso');

            return Redirect::route('Avisos.index');


        // }
        // catch(Exception $e){

        // }

    }

    public function edit(String $id){
        $Aviso = Avisos::find($id);
        return Inertia::render ('Modulos/RH/Avisos/formEditarAviso',[
            'aviso'=>$Aviso,
        ]);
    }

    public function update(String $id,Request $request){
        try{
            $Aviso=Avisos::find($id);
            $Aviso->update($request->all());

            Session::flash('mensaje', 'Se ha guardado los cambios realizados en el aviso');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Avisos.index');
            }
            catch(Exception $e){
                Session::flash('mensaje', 'Ha ocurrido un error al intentar actualizar la informacion del aviso');
                Session::flash('TipoMensaje', 'Error');
                return redirect::route('Avisos.index');
            }
    }

    public function destroy(String $id){
        try{
            $Aviso = Avisos::find($id);
            $Aviso->delete();

            Session::flash('mensaje', 'Se ha eliminado correctamente el aviso');
            Session::flash('TipoMensaje', 'Exitoso');

            return Redirect::route('Avisos.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al eliminar el aviso');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Avisos.index');
        }
    }

    public function Buscar(Request $request){
        $Aviso=$request->input('Aviso');

        $campo = $request->input('campo');

        $result=Avisos::where($campo, 'LIKE', '%'.$Aviso.'%')->get();

        return $result;
    }
}
