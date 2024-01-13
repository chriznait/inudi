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
            $table->string('nombreCurso',500);
            $table->string('abrCurso',10)->unique();
            $table->string('descripcionCurso',600);
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->date('fechaInicioInscripcion');
            $table->date('fechaFinInscripcion');
            $table->integer('cupo');
            $table->string('imagen', 100)->nullable();
            $table->string('linkGrupo',60)->nullable();
            $table->boolean('estado')->default(1); 
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
