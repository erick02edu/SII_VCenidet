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
        $this->call(EstatusEmpleadoSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(SubdireccionSeeder::class);
        $this->call(PeriodosSeeder::class);
        $this->call(AplicacionesPeriodosSeeder::class);
        $this->call(CarrerasSeeder::class);
        // \App\Models\User::factory(10)->create();


    }
}
