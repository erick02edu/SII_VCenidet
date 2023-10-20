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
        Schema::create('Categorias', function (Blueprint $table) {
            $table->id('id');
            $table->string('Descripcion'); // Agrega la nueva columna
            $table->string('Clave'); // Agrega la nueva columna
            $table->integer('Horas'); // Agrega la nueva columna
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
