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


        Schema::table('personal', function (Blueprint $table) {
            
            //LlavesForaneas personal
            $table->unsignedBigInteger('idDepAdscripcion')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idDepAcademico')->nullable(); // Columna para la llave foránea
            $table->foreign('idDepAdscripcion')->references('id')->on('departamentos')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
            $table->foreign('idDepAcademico')->references('id')->on('departamentos')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID

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
