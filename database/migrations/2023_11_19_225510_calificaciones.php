<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('Calificaciones',function(Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('idAlumno')->nullable();
            $table->unsignedBigInteger('idMateria')->nullable();
            $table->float('Calificacion');
            $table->float('NumSemestre');
            $table->unsignedBigInteger('idProfesor')->nullable();

            //Llaves foraneas
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idMateria')->references('id')->on('materias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idProfesor')->references('id')->on('personal')->onDelete('set null')->onUpdate('cascade');

        });
    }

    public function down(): void
    {

    }
    
};
