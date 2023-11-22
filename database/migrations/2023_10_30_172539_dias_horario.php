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
        Schema::create('DiasHorario',function(Blueprint $table){
            $table->id('id');
            $table->time('HInicio');
            $table->time('HFin');
            $table->string('dia',20);
            $table->unsignedBigInteger('idHorario')->nullable(); // Columna para la llave foránea

            //Llaves foraneas
            $table->foreign('idHorario')->references('id')->on('horarios_docentes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
