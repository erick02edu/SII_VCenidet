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
        Schema::create('Avisos',function(Blueprint $table){
            $table->id('id');
            $table->string('Titulo',75); // Columna para la llave foránea
            $table->string('Descripcion',255); // Columna para la llave foránea
            $table->date('FechaPublicacion');
            // $table->unsignedBigInteger('idUsuario')->nullable(); // Columna para la llave foránea
            // $table->unsignedBigInteger('idRol')->nullable(); // Columna para la llave foránea

            //Llaves foraneas
            //$table->foreign('idUsuario')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            //$table->foreign('idRol')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

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
