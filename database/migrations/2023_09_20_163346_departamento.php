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

        Schema::create('departamentos', function (Blueprint $table) {
            $table->id('id');
            $table->string('Nombre'); // Agrega la nueva columna
            $table->string('Descripcion'); // Agrega la nueva columna
            $table->unsignedBigInteger('idEncargado')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idSubdireccion')->nullable(); // Columna para la llave foránea

            $table->foreign('idEncargado')->references('id')->on('personal')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
            $table->foreign('idSubdireccion')->references('id')->on('subdireccion')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
