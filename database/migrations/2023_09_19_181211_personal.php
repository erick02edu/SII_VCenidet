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
        Schema::create('personals', function (Blueprint $table) {
            $table->id('id');
            $table->string('RFC',13); // Agrega la nueva columna
            $table->string('Nombre'); // Agrega la nueva columna
            $table->string('ApellidoP'); // Agrega la nueva columna
            $table->string('ApellidoM'); // Agrega la nueva columna
            $table->date('FechaNacimiento'); // Agrega la nueva columna
            $table->integer('numTarjeta'); // Agrega la nueva columna
            $table->string('Estatus',1);
            $table->string('Estudio 1')->nullable(); // Agrega la nueva columna
            $table->string('Estudio 2')->nullable(); // Agrega la nueva columna
            $table->string('Estudio 3')->nullable(); // Agrega la nueva columna
            $table->unsignedBigInteger('idPlaza')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idUsuario')->nullable(); // Columna para la llave foránea
            $table->foreign('idPlaza')->references('id')->on('plazas')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID

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
