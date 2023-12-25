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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('tipoDocumento', 50);
            $table->string('nroDocumento',10)->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 100)->unique();
            $table->string('telefono', 100)->nullable();
            $table->string('profesion', 100)->nullable();
            $table->string('gradoAcademico', 100);
            $table->integer('idPais');
            $table->integer('idDepartamento');
            $table->integer('idProvincia');
            $table->integer('idDistrito');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
            

