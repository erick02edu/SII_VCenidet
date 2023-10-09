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
        Schema::create('plazas', function (Blueprint $table) {
            $table->id();


            $table->string('diagonal'); // Agrega la nueva columna
            $table->string('unidad'); // Agrega la nueva columna
            $table->string('subunidad'); // Agrega la nueva columna
            $table->integer('horas');
            $table->boolean('estatus');
            $table->unsignedBigInteger('idCategoria')->nullable(); // Columna para la llave foránea
            $table->foreign('idCategoria')->references('id')->on('categorias')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID
            $table->timestamps();
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
