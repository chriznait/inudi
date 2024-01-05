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
        Schema::create('registereds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPersona');
            $table->unsignedBigInteger('idCurso');
            $table->string('montoPagado', 7);
            $table->date('fechaPago');
            $table->integer('idUsuario'); // usuario que valida pago
            $table->integer('estado')->default('1'); //0 = inactivo 1 = registrado 2 = matriculado 3 = certificado
            $table->date('fechaCertificado')->nullable();
            $table->string('codigoCertificado', 30)->nullable();
            //$tbale->string('linkCertificado', 100)->nullable(); 
            $table->date('fechaInscripcion')->nullable();
            $table->timestamps('fechaMatricula')->nullable();
            $table->foreign('idPersona')->references('id')->on('people');
            $table->foreign('idCurso')->references('id')->on('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registereds');
    }
};
