<?php

namespace App\Http\Controllers;

use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioRegistrado;
use Exception;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PersonalController extends Controller
{
    //Constructor
    public function __construct(){
        $this->middleware(['role:Recursos Humanos'])->only('index','indexActivos','indexBajas');
        $this->middleware(['role:Recursos Humanos'])->only('store','create');
        $this->middleware(['role:Recursos Humanos'])->only('edit','update');
        $this->middleware(['role:Recursos Humanos'])->only('destroy');
        //$this->middleware(['role:Recursos Humanos'])->only('asignarCuenta');
        $this->middleware(['role:Recursos Humanos'])->only('asignarPlaza');
    }
    //Ruta index para vista de personal
    public function index(){
        $Pagination=personal::paginate(10);
        $personal=$Pagination->items();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();
        $usuariosDisponibles=app(UserController::class)->ObtenerUsuariosDisponibles();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = personal::all()->count();

        $ArregloFilas=[];
        $EstatusEmpleados=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleados();
        $Departamentos=app(DepartamentoController::class)->ObtenerDepartamentos();
        $Periodos=app(PeriodoController::class)->ObtenerPeriodos();

        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/RH/Personal/Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'usuariosDisponibles'=>$usuariosDisponibles,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
            'Paginator'=>$Pagination,
            'Filtro'=>'Todos',
            'EstatusEmpleado'=>$EstatusEmpleados,
            'departamentos'=>$Departamentos,
            'periodos'=>$Periodos,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]); //Regresar a la vista personal
    }
    public function indexActivos(){

        $Pagination=personal::where('Estatus','A')->paginate(10);
        $personal=$Pagination->items();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();
        $usuariosDisponibles=app(UserController::class)->ObtenerUsuariosDisponibles();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = personal::all()->count();

        $ArregloFilas=[];

        $EstatusEmpleados=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleados();
        $Departamentos=app(DepartamentoController::class)->ObtenerDepartamentos();
        $Periodos=app(PeriodoController::class)->ObtenerPeriodos();

        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        return Inertia::render('Modulos/RH/Personal/Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'usuariosDisponibles'=>$usuariosDisponibles,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
            'Paginator'=>$Pagination,
            'Filtro'=>'Activos',
            'EstatusEmpleado'=>$EstatusEmpleados,
            'departamentos'=>$Departamentos,
            'periodos'=>$Periodos
        ]);
    }
    public function indexBajas(){

        $Pagination=personal::where('Estatus','B')->paginate(10);
        $personal=$Pagination->items();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();
        $usuariosDisponibles=app(UserController::class)->ObtenerUsuariosDisponibles();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = personal::all()->count();

        $ArregloFilas=[];

        $EstatusEmpleados=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleados();
        $Departamentos=app(DepartamentoController::class)->ObtenerDepartamentos();
        $Periodos=app(PeriodoController::class)->ObtenerPeriodos();

        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        return Inertia::render('Modulos/RH/Personal/Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'usuariosDisponibles'=>$usuariosDisponibles,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
            'Paginator'=>$Pagination,
            'Filtro'=>'Bajas',
            'EstatusEmpleado'=>$EstatusEmpleados,
            'departamentos'=>$Departamentos,
            'periodos'=>$Periodos
        ]);
    }
    //Funcion para redirigir a vista para dar de alta un personal
    public function create(){
        $Departamentos=app(DepartamentoController::class)->ObtenerDepartamentos();
        $EstatusEmpleados=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleados();
        $usuarios=app(UserController::class)->ObtenerUsuariosDisponibles();
        return Inertia::render('Modulos/RH/Personal/AltaPersonal',[
            'departamentos'=>$Departamentos,
            'estatus'=>$EstatusEmpleados,
            'usuarios'=>$usuarios
        ]);
    }
    //Funcion para agregar un personal
    public function store(Request $request){

        $Personal=new personal();

        $Personal->ApellidoP=$request->ApellidoP;
        $Personal->ApellidoM=$request->ApellidoM;
        $Personal->Nombre=$request->Nombre;
        $Personal->RFC=$request->RFC;
        $Personal->LugarNacimiento=$request->LugarNacimiento;
        $Personal->FechaNacimiento=$request->FechaNacimiento;
        $Personal->Sexo=$request->Sexo;
        $Personal->EstadoCivil=$request->EstadoCivil;
        $Personal->Direccion=$request->Direccion;
        $Personal->Colonia=$request->Colonia;
        $Personal->CodigoPostal=$request->CodigoPostal;
        $Personal->Ciudad=$request->Ciudad;
        $Personal->EntFederativa=$request->EntFederativa;
        $Personal->Telefono=$request->Telefono;
        $Personal->CURP=$request->CURP;
        $Personal->CorreoPers=$request->CorreoPers;

        $Personal->NivEst1=$request->NivEst1;
        $Personal->GradoMax1=$request->GradoMax1;
        $Personal->Estudio1=$request->Estudio1;

        $Personal->NivEst2=$request->NivEst2;
        $Personal->GradoMax2=$request->GradoMax2;
        $Personal->Estudio2=$request->Estudio2;

        $Personal->NivEst3=$request->NivEst3;
        $Personal->GradoMax3=$request->GradoMax3;
        $Personal->Estudio3=$request->Estudio3;

        $Personal->Titulo=$request->Titulo;

        $Personal->Nombramiento=$request->Nombramiento;
        $Personal->numEmpleado=$request->numEmpleado;
        $Personal->EstatusEmpleado=$request->EstatusEmpleado;

        $Personal->IngAñoSNEST=$request->IngAñoSNEST;
        $Personal->IngQuinSNEST=$request->IngQuinSNEST;

        $Personal->IngAñoGob=$request->IngAñoGob;
        $Personal->IngQuinGob=$request->IngQuinGob;

        $Personal->IngAñoSEP=$request->IngAñoSEP;
        $Personal->IngQuinSEP=$request->IngQuinSEP;

        $Personal->IngAñoPlan=$request->IngAñoPlan;
        $Personal->IngQuinPlan=$request->IngQuinPlan;

        $Personal->TipoAct=$request->TipoAct;


        $Personal->	idDepAdscripcion=$request->idDepAdscripcion;
        $Personal->	idDepAcademico=$request->idDepAcademico;


        $Personal->idUsuario=$request->idUsuario;


        date_default_timezone_set('America/Mexico_City');//Zona horaria Mexico
        $Personal->FechaRegistro=date("Y-m-d");

        $DescripcionEstatus=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleadosPorID($request->EstatusEmpleado);


        if($DescripcionEstatus->Descripcion!='Activo'){
            $Personal->Estatus='B';
            $Personal->idUsuario=null;
        }
        else{
            $Personal->Estatus='A';
            $Personal->idUsuario=$request->idUsuario;
        }

        $Personal->save();

        //Enviar correo si se asigno cuenta
        // if($request->idUsuario!=0){
        //     $user=app(UserController::class)->ObtenerUsuarioPorID($request->idUsuario);
        //     Mail::to($user->email)->send(new UsuarioRegistrado($user));
        // }

        Session::flash('mensaje', 'Se ha registrado el personal correctamente');
        Session::flash('TipoMensaje', 'Exitoso');

        return Redirect::route('Personal.index');
    }
    //Funcion para redirigir a vista para editar un personal
    public function edit(string $id){
        $Departamentos=app(DepartamentoController::class)->ObtenerDepartamentos();
        $EstatusEmpleados=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleados();
        $usuarios=app(UserController::class)->ObtenerUsuariosDisponibles();
        $Personal = personal::find($id);
        if($Personal->idUsuario!=null){
            $cuentaAsignada=app(UserController::class)->ObtenerUsuarioPorID($Personal->idUsuario);
        }
        else{
        $cuentaAsignada=0;
        }
        return Inertia::render ('Modulos/RH/Personal/formEditarPersonal',[
            'personalEditar'=>$Personal,
            'departamentos'=>$Departamentos,
            'estatus'=>$EstatusEmpleados,
            'usuarios'=>$usuarios,
            'cuentaAsignada'=>$cuentaAsignada
        ]);
    }
    //Funcion para ctualizar la informacion de un personal
    public function update(Request $request, string $id){
        try{
            $Personal=personal::find($id);
            $Estatus = $request->input('Estatus');

            $DescripcionEstatus=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleadosPorID($request->input('EstatusEmpleado'));
            //dd($DescripcionEstatus->Descripcion);
            if($DescripcionEstatus->Descripcion!='Activo'){
                $Estatus='B';
                $request->merge(['Estatus' => $Estatus]);
                $Personal->idUsuario=null;
            }
            else{
                $Estatus='A';
                $request->merge(['Estatus' => $Estatus]);
            }

            $DescripcionEstatus=app(EstatusEmpleadoController::class)->ObtenerEstatusEmpleadosPorID($request->EstatusEmpleado);
            $Personal->update($request->all());

            Session::flash('mensaje', 'Cambios guardados correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Personal.index');

        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ocurrio un error al actualizar los datos');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Personal.index');
        }
    }
    //Funcion para eliminar un personal
    public function destroy(string $id){
        $Personal=personal::find($id);
        if($Personal->Estatus=='A'){
            $Personal->Estatus='B';
        }
        else if($Personal->Estatus=='B'){
            $Personal->Estatus='A';
        }
        $Personal->save();
        return redirect::route('Personal.index');
    }
    //Funcion para buscar un personal
    public function buscarPersonal(Request $request){
        $Personal=$request->input('personal');
        $campo = $request->input('campo');
        $Filtro = $request->input('Filtro');
        $Departamento = $request->input('Departamento');
        if($Filtro=='Todos'){
            if($campo=='Nombre'){
                if($Departamento==0){
                    $result=personal::
                    whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Personal.'%'])->get();
                }
                else{
                    $result=personal::
                    whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Personal.'%'])->
                    where('idDepAdscripcion','=',$Departamento)->get();
                }
            }
            else{
                if($Departamento==0){
                    $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->get();
                }
                else{
                    $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
                    where('idDepAdscripcion','=',$Departamento)->get();
                }
            }
        }
        else if($Filtro=='Activos'){
            if($campo=='Nombre'){
                if($Departamento==0){
                    $result=personal::
                    whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Personal.'%'])->
                    where('Estatus','=','A')->get();
                }
                else{
                    $result=personal::
                    whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Personal.'%'])->
                    where('Estatus','=','A')->
                    where('idDepAdscripcion','=',$Departamento)->get();
                }
            }
            else{
                if($Departamento==0){
                    $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
                    where('Estatus','=','A')->get();
                }
                else{
                    $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
                    where('Estatus','=','A')->
                    where('idDepAdscripcion','=',$Departamento)->get();
                }
            }
        }
        else if($Filtro=='Bajas'){
            if($campo=='Nombre'){
                if($Departamento==0){
                    $result=personal::
                    whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Personal.'%'])->
                    where('Estatus','=','B')->get();
                }
                else{
                    $result=personal::
                    whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Personal.'%'])->
                    where('Estatus','=','B')->
                    where('idDepAdscripcion','=',$Departamento)->get();
                }
            }
            else{
                if($Departamento==0){
                    $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
                    where('Estatus','=','B')->get();
                }
                else{
                    $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
                    where('Estatus','=','B')->
                    where('idDepAdscripcion','=',$Departamento)->get();
                }

            }
        }
        return $result;
    }
    //Funcion para asignar una plaza a un personal
    public function asignarPlaza(Request $request){
        $Personal=personal::find($request->input('idPersonal'));
        $Personal->idPlaza=$request->input('idPlaza');
        $Personal->save();
        return redirect::route('Personal.index');
    }
    //Funcion para asignar cuenta a un personal
    public function asignarCuenta(Request $request){
        $Personal=personal::find($request->input('idPersonal'));
        $Personal->idUsuario=$request->input('idCuenta');
        $Personal->save();
    }
    //Funcion para obtener lista del personal
    public function ObtenerPersonal(){
        $Personal=personal::all();
        return $Personal;
    }
    //Funcion para obtener el personal deado de alta
    public function ObtenerPersonalAlta(){
        $Personal=personal::where('Estatus','=','A')->get();
        return $Personal;
    }
    //Funcion para obtener personal por medio del id
    public function ObtenerPersonalPorID(String $id){
        $Personal=personal::find($id);
        return $Personal;
    }
    //Funcion para obtener todo el personal de un departamento
    public function ObtenerPersonalDepartamento(Request $request){
        $departamento = $request->input('departamento');
        $Personal=personal::where('idDepAdscripcion','=',$departamento)->get();
        if($Personal->isEmpty()){
            $Personal=[];
        }
        return response()->json(['Personal'=>$Personal]);
    }
    //Funcion que redirige a la vista para los reportes relacionados con el personal
    public function Reportes(){
        return Inertia::render ('Modulos/RH/Reportes/Reportes',[
        ]);
    }
    //Funciones para obtener el personal que no tiene una cuenat de usuario
    public function ObtenerPersonalSinCuenta(){
        $PersonalSinCuenta=Personal::where('idUsuario',null)->get(['id','Nombre','ApellidoP','ApellidoM']);
        return $PersonalSinCuenta;
    }
    public function PersonalDepartamento(Request $request){
        $departamento = $request->input('departamento');
        $Personal=personal::where('idDepAdscripcion','=',$departamento)->get();
        if($Personal->isEmpty()){
            $Personal=[];
        }
        return $Personal;
    }

    //Funcion para verificar si existe un personal con un cierto ID
    public function VerificarExistencia(String $id){
        $Persona=Personal::find($id);
        if($Persona){
            return true;
        }
        else{
            return false;
        }
    }
}
