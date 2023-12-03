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
        Schema::create('bajasPersonal',function(Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('idPersonal');  // Perosnal dado de baja
            $table->unsignedBigInteger('idEstatus'); // Columna para la llave foránea
            $table->date('FechaBaja');

            $table->foreign('idPersonal')->references('id')->on('personal')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idEstatus')->references('id')->on('estatus empleado')->onDelete('cascade')->onUpdate('cascade');
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
