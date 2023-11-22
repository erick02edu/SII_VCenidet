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
        Schema::create('VigenciaPersonal',function(Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('idPersonal')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idPeriodo')->nullable(); // Columna para la llave foránea
            $table->date('InicioVigencia');
            $table->date('FinVigencia');
            //Llaves foraneas
            $table->foreign('idPersonal')->references('id')->on('personal')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idPeriodo')->references('id')->on('periodos')->onDelete('set null')->onUpdate('cascade');
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
