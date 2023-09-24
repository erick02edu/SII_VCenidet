<?php

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
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\DepartamentoController;
use App\Models\categoria;
use App\Models\Departamentos;
use App\Models\User;
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
 Route::get('Roles/{Role}/editPermisos',[PermissionController::class,'EditPermisos'])->name('Roles.editPermisos')->middleware('auth:sanctum','verified');//Ruta que redirige a la vista para asignar un Rol


 Route::post('Permisos/can',[PermissionController::class,'can'])->name('Permisos.can')->middleware('auth:sanctum','verified');

 //Fecha Reinscripciones
 Route::get('Inscripcion/RegistroFecha',[FechaReincripcionController::class,'index'])->name('FechaReinscripcion.index')->middleware('auth:sanctum','verified');

//Promedio
Route::get('Promedios',[PromedioController::class,'index'])->name('Promedio.index')->middleware('auth:sanctum','verified');

//Periodos escolares
Route::get('Periodo',[PeriodoController::class,'index'])->name('Periodo.index')->middleware('auth:sanctum','verified');

//Periodo de aplicacion

Route::resource('Aplicaciones',AplicacionPeriodoController::class)
->middleware('auth:sanctum','verified')->only(['index','destroy']);

Route::post('AplicacionActualizar',[AplicacionPeriodoController::class,'actualizar'])->name('Aplicaciones.actualizar')->middleware('auth:sanctum','verified');

//Rutas a categorias

Route::resource('categorias',CategoriaController::class)
->middleware('auth:sanctum','verified')->only(['index']);


 //Rutas para respaldo
 Route::resource('backup',BackupController::class)
 ->middleware('auth:sanctum','verified')->only(['index']);

 Route::get('GenerarBackup',[BackupController::class,'Generar'])->name('GenerarBackup')->middleware('auth:sanctum','verified');



 Route::get('Preuba.index',[BackupController::class,'Prueba'])->name('Prueba.index')->middleware('auth:sanctum','verified');
