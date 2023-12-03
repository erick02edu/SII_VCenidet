<?php

use App\Http\Controllers\AlumnosController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PDFController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FechaReincripcionController;
use App\Http\Controllers\PromedioController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\AplicacionPeriodoController;
use App\Http\Controllers\AvisosController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\bajasPersonalController;
use App\Http\Controllers\CalificacionesController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClasesController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DiasHorarioController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\horariosDocentesController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\PermisosCarrerasController;
use App\Http\Controllers\VigenciaPersonalController;
use App\Models\Calificaciones;
use App\Models\categoria;
use App\Models\Clases;
use App\Models\Departamentos;
use App\Models\DiasHorario;
use App\Models\horariosDocentes;
use App\Models\User;
use App\Models\VigenciaPersonal;
use FontLib\Table\Type\name;
use Spatie\Permission\Contracts\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return redirect()->route('login');
    // return Inertia::render('login', [
    //     // 'canLogin' => Route::has('login'),
    //     // 'canRegister' => Route::has('register'),
    //     // 'laravelVersion' => Application::VERSION,
    //     // 'phpVersion' => PHP_VERSION,
    // ]);
});

Route::middleware([
     'auth:sanctum',
     config('jetstream.auth_session'),
     'verified',
 ])->group(function () {



    //Rutas para crud Plazas
    Route::resource('Plazas',PlazaController::class);

    Route::resource('Calificaciones',CalificacionesController::class)->only(['index']);
    Route::post('Calificaciones.subir',[CalificacionesController::class,'SubirCalificaciones'])->name('Calificaciones.subir');
    Route::post('Calificaciones.Actualizar',[CalificacionesController::class,'ActualizarCalificaciones'])->name('Calificaciones.Actualizar');
    Route::get('Calificaciones.buscar',[CalificacionesController::class,'Buscar']);
    Route::get('Calificaciones.Promedios',[CalificacionesController::class,'Promedios'])->name('Calificaciones.Promedios');
    Route::post('Calificaciones.historial',[CalificacionesController::class,'GenerarHistorial'])->name('Calificaciones.historial');

    //bajas Personalnal
    Route::resource('bajasPersonal',bajasPersonalController::class)->only('store');

    //Rutas para crud Grupos
    Route::resource('Grupos',GruposController::class);
    Route::get('Grupos.buscar',[GruposController::class,'Buscar']);
    Route::get('GruposAlumnos/{id}',[GruposController::class,'EditarAlumnos'])->name('Grupos.Alumnos');

    //Rutas para crud horarios docentes
    Route::resource('HorariosDocentes',horariosDocentesController::class);
    Route::get('HorarioAdministrativo/{idHorario}',[horariosDocentesController::class,'editAdministrativo'])->name('HorariosDocentes.editAdmin');
    Route::get('HorariosDocentes/{idHorario}/ver',[horariosDocentesController::class,'Ver'])->name('HorariosDocentes.ver');

    //Avisos
    Route::resource('Avisos',AvisosController::class);
    Route::get('Avisos.buscar',[AvisosController::class,'Buscar']);

    //Carreras
    Route::get('/Carreras.buscar',[CarreraController::class,'Buscar'])->name('Carreras.buscar');

    //reporte PDF

    //Route::get('HorariosDocentesPDF/{idHorario}',[horariosDocentesController::class,'GenerarPDF'])->name('HorariosDocentes.PDF')->middleware('auth:sanctum','verified');
    Route::get('/formatoPDF/{id}',[horariosDocentesController::class,'FormatoPDF'])->name('HorarioPDF');
    Route::get('/HorConcentrado/{periodo}',[horariosDocentesController::class,'HorarioConcentrado'])->name('HorConcentrado');
    Route::get('HorariosDocentesExcel/{idHorario}',[horariosDocentesController::class,'GenerarExcel'])->name('HorariosDocentes.Excel');
    Route::get('HorariosDocentes.buscar',[horariosDocentesController::class,'buscarHorario']);



    //Rutas para crud vigencia Personal
    Route::resource('VigenciaPersonal',VigenciaPersonalController::class)->only(['store','update']);
    Route::get('VigenciaPersonal/{idPersonal}/{idPeriodo}',[VigenciaPersonalController::class,'editVigencia'])->name('VigenciaPersonal.edit');


    //Rutas para crud Alumnos
    Route::resource('Alumnos',AlumnosController::class);
    Route::get('Alumnos.buscar',[AlumnosController::class,'Buscar']);
    Route::post('Alumnos.AsignarGrupo',[AlumnosController::class,'AsignarGrupo'])->name('Alumnos.AsignarGrupo');
    Route::put('Alumnos.QuitarGrupo/{id}',[AlumnosController::class,'QuitarGrupo'])->name('Alumnos.QuitarGrupo');
    Route::post('Alumnos.importar', [AlumnosController::class, 'ImportarDatos']);
    Route::get('Alumnos.Grupo/{id}',[AlumnosController::class,'AlumnosPorGrupo'])->name('Alumnos.Grupo');

    //PERMISOS CARRERA
    Route::get('PermisosCarrera.buscar/{id}',[PermisosCarrerasController::class,'ObtenerPermisosCarrera'])->name('PermisosCarrera.buscar');
    Route::get('/PermisosCarreras.asignar',[PermisosCarrerasController::class,'AsignarPermisos'])->name('PermisosCarreras.asignar');


    //Route::get('PermisosCarreras.eliminar',[PermisosCarrerasController::class,'EliminarPermiso'])->name('PermisosCarreras.eliminar');
    Route::get('/PermisosCarreras.Eliminar',[PermisosCarrerasController::class,'EliminarPermiso']);

    //Rutas para crud clases
    Route::resource('Clases',ClasesController::class)->only(['store','destroy']);

    //Rutas para crud clases
    Route::resource('Dias',DiasHorarioController::class)->only(['store','destroy']);



    //Rutas para Materias
    Route::resource('Materias',MateriasController::class);
    Route::get('Materias.buscar',[MateriasController::class,'buscar']);

    //Rutas a categorias
    Route::resource('categorias',CategoriaController::class);
    Route::get('categorias.buscar',[CategoriaController::class,'buscar']);
    Route::get('categorias.paginacion',[CategoriaController::class,'cambiarPaginacion']);
    //Ruta dashboard
    Route::get('/dashboard',[RoleController::class,'verDashboard'])->name('dashboard');





 });

 //Rutas para crud Aulas
 Route::resource('Aulas',AulaController::class)
 ->middleware('auth:sanctum','verified');

 Route::get('Aula.buscar',[AulaController::class,'Buscar']);

//  //Rutas para crud Plazas
//  Route::resource('Plazas',PlazaController::class)
//  ->middleware('auth:sanctum','verified');

Route::get('Plazas.buscar',[PlazaController::class,'buscarPlaza'])
->middleware('auth:sanctum','verified');

Route::get('Plazas.Asignadas',[PlazaController::class,'indexAsignadas'])
->middleware('auth:sanctum','verified')->name('Plazas.Asignadas');

Route::get('Plazas.SinAsignar',[PlazaController::class,'indexNoAsignadas'])
->middleware('auth:sanctum','verified')->name('Plazas.SinAsignar');;


 //Rutas para crud usuarios
 Route::resource('Users',UserController::class)
 ->middleware('auth:sanctum','verified');

 Route::get('Users.buscar',[UserController::class,'buscarUsuario'])
 ->middleware('auth:sanctum','verified');

 //Rutas para crud Roles
 Route::resource('Roles',RoleController::class)
 ->middleware('auth:sanctum','verified');

 Route::get('Roles.buscar',[RoleController::class,'buscarRol'])
->middleware('auth:sanctum','verified');

//Rutas para crud de personal
Route::resource('Personal',PersonalController::class)
->middleware('auth:sanctum','verified');

Route::get('Personal.Activos',[PersonalController::class,'indexActivos'])
->middleware('auth:sanctum','verified')->name('Personal.Activos');

Route::get('Personal.Bajas',[PersonalController::class,'indexBajas'])
->middleware('auth:sanctum','verified')->name('Personal.Bajas');;

Route::get('Personal.buscar',[PersonalController::class,'buscarPersonal'])
->middleware('auth:sanctum','verified');


Route::get('Personal.Reportes',[PersonalController::class,'Reportes'])
->middleware('auth:sanctum','verified')->name('Personal.Reportes');


Route::post('Personal.Rotacion',[PersonalController::class,'ReporteRotacion'])
->middleware('auth:sanctum','verified')->name('Personal.Rotacion');


Route::post('Personal.asignarPlaza',[PersonalController::class,'asignarPlaza'])->name('Personal.asignarPlaza')
->middleware('auth:sanctum','verified');

Route::post('Personal.asignarCuenta',[PersonalController::class,'asignarCuenta'])->name('Personal.asignarCuenta')
->middleware('auth:sanctum','verified');

Route::get('Personal.Filtro',[PersonalController::class,'Filtro'])
->middleware('auth:sanctum','verified');

Route::get('Personal.Departemento',[PersonalController::class,'ObtenerPersonalDepartamento'])
->middleware('auth:sanctum','verified');


 //Rutas para crud departamentos
 Route::resource('Departamentos',DepartamentoController::class)
 ->middleware('auth:sanctum','verified');
 Route::get('Departamentos.buscar',[DepartamentoController::class,'buscarDepartamento'])
->middleware('auth:sanctum','verified');

 //Rutas para definir Role a Usuario
 Route::get('RolUsuario',[RoleController::class,'ObtenerRolUsuarioAutenticado']); //Ruta pra obtener los roles que tiene el usuario actualmente authenticado

 Route::get('GetRolesUsuario{id}',[RoleController::class,'ObtenerRolUsuario'])->name('GetRolesUsuario')->middleware('auth:sanctum','verified'); //Ruta pra obtener los roles que tiene el usuario actualmente authenticado

 Route::get('Users/{User}/editRole',[RoleController::class,'EditRole'])->name('Users.editRole')->middleware('auth:sanctum','verified');//Ruta que redirige a la vista para asignar un Rol
 Route::get('GetRoles',[RoleController::class,'GetRoles'])->name('Users.getRoles')->middleware('auth:sanctum','verified');//Ruta que permite obtener todos los Roles

 Route::get('AsignarRol',[RoleController::class,'asignarRol'])->name('Roles.asignar')->middleware('auth:sanctum','verified');//Ruta que permite obtener todos los Roles

 Route::post('Roles/can',[RoleController::class,'can'])->name('Roles.can')->middleware('auth:sanctum','verified');

//Permisos

Route::get('GetPermisosRol{id}',[PermissionController::class,'ObtenerPermisosRol'])->name('GetPermisosRol')->middleware('auth:sanctum','verified'); //Ruta pra obtener los roles que tiene el usuario actualmente authenticado

 Route::get('GetPermisos',[PermissionController::class,'GetPermisos'])->name('Permisos.getPermisos')->middleware('auth:sanctum','verified');//Ruta que permite obtener todos los Roles
 Route::get('AsignarPermisos',[PermissionController::class,'asignarPermisos'])->name('Permisos.asignar')->middleware('auth:sanctum','verified');//Ruta que permite obtener todos los Roles
 Route::get('Roles/{Role}/editPermisos',[PermissionController::class,'editPermisos'])->name('Roles.editPermisos')->middleware('auth:sanctum','verified');//Ruta que redirige a la vista para asignar un Rol
 Route::get('/Permisos.remover',[PermissionController::class,'RemoverPermiso']);

 Route::get('/Permisos.asignarUsuario',[PermissionController::class,'AsignarPermisosUsuario'])->name('Permisos.asignarUsuario')->middleware('auth:sanctum','verified');//Ruta que permite obtener todos los Roles

 Route::post('Permisos/can',[PermissionController::class,'can'])->name('Permisos.can')->middleware('auth:sanctum','verified');
 Route::get('Permisos.buscarUsuario/{id}',[PermissionController::class,'ObtenerPermisosUsuario'])->name('Permisos.buscarUsuario');
 Route::get('/Permisos.buscar',[PermissionController::class,'Buscar'])->name('Permisos.buscar');


 //Fecha Reinscripciones
 Route::get('Inscripcion/RegistroFecha',[FechaReincripcionController::class,'index'])->name('FechaReinscripcion.index')->middleware('auth:sanctum','verified');

//Promedio
Route::get('Promedios',[PromedioController::class,'index'])->name('Promedio.index')->middleware('auth:sanctum','verified');

//Periodos escolares
Route::get('Periodo',[PeriodoController::class,'index'])->name('Periodo.index')->middleware('auth:sanctum','verified');

//Periodo de aplicacion

Route::resource('Aplicaciones',AplicacionPeriodoController::class)
->middleware('auth:sanctum','verified')->only(['index','destroy','store']);

Route::post('AplicacionActualizar',[AplicacionPeriodoController::class,'actualizar'])->name('Aplicaciones.actualizar')->middleware('auth:sanctum','verified');
Route::get('Aplicaciones.buscar',[AplicacionPeriodoController::class,'buscarAplicacion'])->middleware('auth:sanctum','verified');



 //Rutas para respaldo
 Route::resource('backup',BackupController::class)
 ->middleware('auth:sanctum','verified')->only(['index']);

 use Illuminate\Support\Facades\Artisan;

 //Route::get('GenerarBackup',[BackupController::class,'Generar'])->name('GenerarBackup')->middleware('auth:sanctum','verified');
 Route::get('GenerarBackup', function() {

    Artisan::call('backup:run');
    dd(Artisan::output());

  })->name('GenerarBackup');


 Route::get('Prueba.index',[BackupController::class,'Prueba'])->name('Prueba.index')->middleware('auth:sanctum','verified');



 //Prueba mail
Route::get('PruebaMail.index',function(){
    return Inertia::render('PruebaMail');
})->name('PruebaMail.index');

Route::get('/reporte', function () {
    //return view('Reportes.Horarios');
    return view('Reportes.HorarioPDF');
});


Route::get('/AvisoEmail', function () {
    //return view('Reportes.Horarios');
    //return view('emails.NuevoAviso');
    return view('emails.CorreoRegistro');
});

Route::get('/reporte/{id}',[horariosDocentesController::class,'verExcel'])->name('/reporte{id}');




Route::get('PruebaReporte',[PDFController::class,'generatePDF'])->name('PruebaReporte');





