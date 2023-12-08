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
        // Schema::create('historial__Alumnos', function (Blueprint $table) {
        //     $table->id('id');
        //     $table->string('noControl');
        //     $table->string('Materia');
        //     $table->float('Calificacion');
        //     $table->unsignedBigInteger('idPeriodo')->nullable(); // Columna para la llave foránea
        //     $table->foreign('idPeriodo')->references('id')->on('Periodos')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
