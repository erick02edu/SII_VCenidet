<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('personal', function (Blueprint $table) {
            //DATOS PERSONALES
            $table->id('id');

            $table->string('ApellidoP'); // Agrega la nueva columna
            $table->string('ApellidoM'); // Agrega la nueva columna
           $table->string('Nombre'); // Agrega la nueva columna
            $table->string('RFC',13); // Agrega la nueva columna
            $table->string('LugarNacimiento'); // Agrega la nueva columna
            $table->date('FechaNacimiento'); // Agrega la nueva columna
            $table->string('Sexo'); // Agrega la nueva columna
            $table->string('EstadoCivil'); // Agrega la nueva columna
            $table->string('Direccion'); // Agrega la nueva columna
            $table->string('Colonia'); // Agrega la nueva columna
            $table->string('CodigoPostal',5)->nullable(); // Agrega la nueva columna
            $table->string('Ciudad'); // Agrega la nueva columna
            $table->string('EntFederativa'); // Agrega la nueva columna
            $table->string('Telefono',15); // Agrega la nueva columna
            $table->string('CURP',18); // Agrega la nueva columna
            $table->string('CorreoPers')->nullable(); // Agrega la nueva columna

            //Formacion academica

            $table->string('NivEst1')->nullable(); // Agrega la nueva columna
            $table->string('NivEst2')->nullable(); // Agrega la nueva columna
            $table->string('NivEst3')->nullable(); // Agrega la nueva columna

            $table->integer('GradoMax1')->nullable(); // Agrega la nueva columna
            $table->integer('GradoMax2')->nullable(); // Agrega la nueva columna
            $table->integer('GradoMax3')->nullable(); // Agrega la nueva columna

            $table->string('Estudio1')->nullable(); // Agrega la nueva columna
            $table->string('Estudio2')->nullable(); // Agrega la nueva columna
            $table->string('Estudio3')->nullable(); // Agrega la nueva columna

            $table->string('Titulo')->nullable(); // Agrega la nueva columna

            //Informacion Laboral
            $table->string('Nombramiento'); // Agrega la nueva columna
            $table->integer('numEmpleado'); // Agrega la nueva columna
            //$table->string('idEstatusEmpleado');//Cambiar
            $table->string('Estatus',1);

            $table->integer('IngAñoSNEST')->nullable();
            $table->integer('IngQuinSNEST')->nullable();

            $table->integer('IngAñoGob')->nullable();
            $table->integer('IngQuinGob')->nullable();

            $table->integer('IngAñoSEP')->nullable();
            $table->integer('IngQuinSEP')->nullable();

            $table->integer('IngAñoPlan')->nullable();
            $table->integer('IngQuinPlan')->nullable();

            $table->string('TipoAct');


            //Fecha de registro
            $table->date('FechaRegistro');

            $table->unsignedBigInteger('idPlaza')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('idUsuario')->nullable(); // Columna para la llave foránea
            $table->unsignedBigInteger('EstatusEmpleado')->nullable(); // Columna para la llave foránea

            $table->foreign('idPlaza')->references('id')->on('plazas')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla plaza por el campo ID
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID
            $table->foreign('EstatusEmpleado')->references('id')->on('estatus empleado')->onDelete('set null'); // Establecer eliminación en cascada; //Generar llave foranea con tabla users por el campo ID

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
