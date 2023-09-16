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
        Schema::table('plazas', function (Blueprint $table) {
            $table->string('diagonal'); // Agrega la nueva columna
            $table->string('unidad'); // Agrega la nueva columna
            $table->string('subunidad'); // Agrega la nueva columna
            $table->unsignedBigInteger('idPersonal')->nullable(); // Columna para la llave foránea
            //Falta estatus
            $table->foreign('idPersonal')->references('id')->on('users')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID

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
