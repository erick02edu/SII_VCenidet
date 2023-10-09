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
        Schema::create('Clases',function(Blueprint $table){
            $table->id('id');
            $table->time('HInicio');
            $table->time('HFin');
            $table->string('dia',20);
            $table->string('color','10');
            $table->unsignedBigInteger('idMateria')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idAula')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idGrupo')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idHorario')->nullable(); // Columna para la llave foránea

            //Llaves foraneas
            $table->foreign('idMateria')->references('id')->on('materias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idAula')->references('id')->on('aulas')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('idGrupo')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idHorario')->references('id')->on('horarios_docentes')->onDelete('cascade')->onUpdate('cascade');
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
