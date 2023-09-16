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


        User::create([
            'name' => 'Jorge Perez',
            'email' => 'Jorge@gmail.com',
            'password' => Hash::make('password'),
        ])->syncRoles(['Administrador','Profesor','Usuario RH']) ;

        $User=User::factory()->times(10)->create();

    }
}
