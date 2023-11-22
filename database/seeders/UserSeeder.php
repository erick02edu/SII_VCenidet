<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //$User=User::factory()->times(80)->create();
        $users = User::factory()->unverified()->count(80)->create();

        User::factory()->create([
            'name' => 'Jorge',
           'email' => 'rbeo201569@upemor.edu.mx',
           'password' => Hash::make('password'),
           'estatus' => 1, // O el valor apropiado para el campo 'estatus'
       ])->assignRole('Usuario RH');;

       User::factory()->create([
        'name' => 'Erick',
       'email' => 'erickrra11@gmail.com',
       'password' => Hash::make('password'),
       'estatus' => 1, // O el valor apropiado para el campo 'estatus'
        ])->assignRole('Administrador');;

    }
}
