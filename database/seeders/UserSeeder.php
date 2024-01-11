<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        //$User=User::factory()->times(80)->create();
        //$users = User::factory()->unverified()->count(80)->create();

        User::factory()->create([
            'name' => 'RecHum',
           'email' => 'rbeo201569@upemor.edu.mx',
           'password' => Hash::make('password'),
           'estatus' => 1, // O el valor apropiado para el campo 'estatus'
       ])->assignRole('Recursos Humanos');;

       User::factory()->create([
        'name' => 'Admin',
       'email' => 'erickrra11@gmail.com',
       'password' => Hash::make('password'),
       'estatus' => 1, // O el valor apropiado para el campo 'estatus'
        ])->assignRole('Administrador');


       User::factory()->create([
        'name' => 'AcadDA',
       'email' => 'erickrra11@gmail.com',
       'password' => Hash::make('password'),
       'estatus' => 1, // O el valor apropiado para el campo 'estatus'
        ])->assignRole('Academicos');


        User::factory()->create([
            'name' => 'DEPI',
           'email' => 'erickrra11@gmail.com',
           'password' => Hash::make('password'),
           'estatus' => 1, // O el valor apropiado para el campo 'estatus'
        ])->assignRole('Division de estudios Profesionales');


        User::factory()->create([
            'name' => 'HPlaneacion',
            'email' => 'erickrra11@gmail.com',
            'password' => Hash::make('password'),
            'estatus' => 1, // O el valor apropiado para el campo 'estatus'
        ])->assignRole('Academicos');



    }
}
