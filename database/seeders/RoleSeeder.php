<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName='sanctum';

        $roleAdmin=Role::create(['name'=>'Administrador']);
        $roleRH=Role::create(['name'=>'Usuario RH']);
        $roleProfesor=Role::create(['name'=>'Profesor']);


        //PLAZAS
        Permission::create(['name'=>'Agregar Plazas']);
        Permission::create(['name'=>'Editar Plazas']);
        Permission::create(['name'=>'Eliminar Plazas']);
        Permission::create(['name'=>'Ver Plazas']);

        //ROLES
        Permission::create(['name'=>'Agregar Roles']);
        Permission::create(['name'=>'Editar Roles']);
        Permission::create(['name'=>'Eliminar Roles']);
        Permission::create(['name'=>'Ver Roles']);

        //USUARIOS
        Permission::create(['name'=>'Agregar Usuarios']);
        Permission::create(['name'=>'Editar Usuarios']);
        Permission::create(['name'=>'Eliminar Usuarios']);
        Permission::create(['name'=>'Ver Usuarios']);

        //AULAS
        Permission::create(['name'=>'Agregar Aulas']);
        Permission::create(['name'=>'Editar Aulas']);
        Permission::create(['name'=>'Eliminar Aulas']);
        Permission::create(['name'=>'Ver Aulas']);

        //FECHA REINSCRIPCION
        Permission::create(['name'=>'Generar fechas de reinscripciones']);
    }

}
