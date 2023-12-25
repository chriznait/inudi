<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = [
            'nombreCurso' => 'CERTIFICADO DE TRABAJO - DIRECTOR Y EDITOR JEFE',
            'abrCurso' => 'crt1',
            'descripcionCurso' => 'CERTIFICADO DE TRABAJO - DIRECTOR Y EDITOR JEFE',
            'fechaInicio' => '26-12-2018',
            'fechaFin' => '20-02-2022',
            'fechaInicioInscripcion' => '26-12-2018',
            'fechaFinInscripcion' => '20-02-2022',
            'cupo' => '60',
            'estado' => 1,
        ]; 
        return [
            //
        ];
    }
}
