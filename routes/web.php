<?php

use App\Http\Controllers\AlumnosController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AulaController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FechaReincripcionController;
use App\Http\Controllers\PromedioController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\AplicacionPeriodoController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClasesController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\horariosDocentesController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\ProfesoresController;
use App\Models\categoria;
use App\Models\Clases;
use App\Models\Departamentos;
use App\Models\horariosDocentes;
use App\Models\User;
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

    //  Route::get('/dashboard', function () {
    //      return Inertia::render('Dashboard');
    //  })->name('dashboard');

    //Rutas para crud Plazas
    Route::resource('Plazas',PlazaController::class);


    //Rutas para crud Grupos
    Route::resource('Grupos',GruposController::class);

    //Rutas para crud Profesores
    Route::resource('Profesores',ProfesoresController::class);


    //Rutas para crud horarios docentes
    Route::resource('HorariosDocentes',horariosDocentesController::class);
    Route::get('HorariosDocentes/{idHorario}/ver',[horariosDocentesController::class,'Ver'])->name('HorariosDocentes.ver');
    //reporte PDF
    Route::get('HorariosDocentesPDF/{idHorario}',[horariosDocentesController::class,'GenerarPDF'])->name('HorariosDocentes.PDF')->middleware('auth:sanctum','verified');
    Route::get('HorariosDocentesExcel/{idHorario}',[horariosDocentesController::class,'GenerarExcel'])->name('HorariosDocentes.Excel')->middleware('auth:sanctum','verified');

    //Rutas para crud Alumnos
    Route::resource('Alumnos',AlumnosController::class);

    //Rutas para crud clases
    Route::resource('Clases',ClasesController::class)->only(['store','destroy']);


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


//  //Rutas para crud Plazas
//  Route::resource('Plazas',PlazaController::class)
//  ->middleware('auth:sanctum','verified');

Route::get('Plazas.buscar',[PlazaController::class,'buscarPlaza'])
->middleware('auth:sanctum','verified');

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

Route::post('Personal.asignarPlaza',[PersonalController::class,'asignarPlaza'])->name('Personal.asignarPlaza')
->middleware('auth:sanctum','verified');

Route::post('Personal.asignarCuenta',[PersonalController::class,'asignarCuenta'])->name('Personal.asignarCuenta')
->middleware('auth:sanctum','verified');

Route::get('Personal.Filtro',[PersonalController::class,'Filtro'])
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


 Route::post('Permisos/can',[PermissionController::class,'can'])->name('Permisos.can')->middleware('auth:sanctum','verified');

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

 Route::get('GenerarBackup',[BackupController::class,'Generar'])->name('GenerarBackup')->middleware('auth:sanctum','verified');



 Route::get('Prueba.index',[BackupController::class,'Prueba'])->name('Prueba.index')->middleware('auth:sanctum','verified');



 //Prueba mail
Route::get('PruebaMail.index',function(){
    return Inertia::render('PruebaMail');
})->name('PruebaMail.index');

Route::get('/reporte', function () {
    return view('Reportes.Horarios');
});

Route::get('/reporte/{id}',[horariosDocentesController::class,'verExcel'])->name('/reporte{id}');
