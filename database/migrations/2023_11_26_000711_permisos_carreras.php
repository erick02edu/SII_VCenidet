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
        Schema::create('PermisosCarreras',function(Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('idCarrera')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idUsuario')->nullable(); // Columna para la llave foránea

            //Llaves foraneas
            $table->foreign('idCarrera')->references('id')->on('carreras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
