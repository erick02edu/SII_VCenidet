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
        Schema::create('horarios_docentes', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('idProfesor')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idPeriodo')->nullable(); // Columna para la llave foránea
            //$table->foreign('idProfesor')->references('id')->on('profesores')->onDelete('cascade'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
            $table->foreign('idProfesor')->references('id')->on('personal')->onDelete('cascade'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
            $table->foreign('idPeriodo')->references('id')->on('periodos')->onDelete('cascade'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
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
