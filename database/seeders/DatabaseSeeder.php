<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);


        // \App\Models\User::factory(10)->create();

        User::factory()->create([
             'name' => 'Jorge',
            'email' => 'Jorge@gmail.com',
            'password' => Hash::make('password'),
            'estatus' => 1, // O el valor apropiado para el campo 'estatus'
        ])->assignRole('Administrador');;
    }
}
