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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCurso',100);
            $table->string('abrCurso',6);
            $table->string('descripcionCurso',200);
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->date('fechaInicioInscripcion');
            $table->date('fechaFinInscripcion');
            $table->integer('cupo');
            $table->boolean('estado'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
