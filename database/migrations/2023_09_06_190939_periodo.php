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
        Schema::create('Periodos', function (Blueprint $table) {
            $table->id('id');
            $table->string('mesInicio');
            $table->string('AñoInicio');
            $table->string('mesTermino');
            $table->string('AñoTermino');
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
