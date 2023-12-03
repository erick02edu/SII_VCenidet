<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Alumnos',function(Blueprint $table){
            $table->id('id');
            $table->string('Nombre');
            $table->string('ApellidoP');
            $table->string('ApellidoM');
            $table->date('FechaNac');
            $table->string('noControl')->unique(); //No repetir num.Control
            $table->string('curp');
            $table->string('Direccion');
            $table->string('Genero');
            $table->string('Telefono')->nullable();

            $table->unsignedBigInteger('idCarrera')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idGrupo')->nullable(); // Columna para la llave foránea
            //Llaves foraneas
            $table->foreign('idGrupo')->references('id')->on('grupos')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('idCarrera')->references('id')->on('carreras')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
