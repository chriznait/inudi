<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombreCurso' => 'required|string|max:255',
            'abrCurso'  => 'required|string|max:25',
            'descripcionCurso' => 'required|string|max:255',
            'cupo' => 'required|numeric',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after:fechaInicio',
            'fechaInicioInscripcion' => 'required|date',
            'fechaFinInscripcion' => 'required|date|after:fechaInicioInscripcion',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];
    }

     public function messages(){
            return [
                'nombreCurso.required' => 'El campo Nombre es obligatorio',
                'nombreCurso.string' => 'El campo Nombre debe ser texto',
                'nombreCurso.max' => 'El campo Nombre debe tener máximo 255 caracteres',
                'abrCurso.required' => 'El campo Abreviatura es obligatorio',
                'abrCurso.string' => 'El campo Abreviatura debe ser texto',
                'abrCurso.max' => 'El campo Abreviatura debe tener máximo 25 caracteres',
                'descripcionCurso.required' => 'El campo Descripción es obligatorio',
                'descripcionCurso.string' => 'El campo Descripción debe ser texto',
                'descripcionCurso.max' => 'El campo Descripción debe tener máximo 255 caracteres',
                'cupo.required' => 'El campo Cupo es obligatorio',
                'cupo.numeric' => 'El campo Cupo debe ser numérico',
                'fechaInicio.required' => 'El campo Fecha Inicio es obligatorio',
                'fechaInicio.date' => 'El campo Fecha Inicio debe ser una fecha',
                'fechaFin.required' => 'El campo Fecha Fin es obligatorio',
                'fechaFin.date' => 'El campo Fecha Fin debe ser una fecha',
                'fechaFin.after' => 'El campo Fecha Fin debe ser posterior a la Fecha Inicio',
                'fechaInicioInscripcion.required' => 'El campo Fecha Inicio Inscripción es obligatorio',
                'fechaInicioInscripcion.date' => 'El campo Fecha Inicio Inscripción debe ser una fecha',
                'fechaFinInscripcion.required' => 'El campo Fecha Fin Inscripción es obligatorio',
                'fechaFinInscripcion.date' => 'El campo Fecha Fin Inscripción debe ser una fecha',
                'fechaFinInscripcion.after' => 'El campo Fecha Fin Inscripción debe ser posterior a la Fecha Inicio Inscripción',
                'imagen.required' => 'El campo Imagen es obligatorio',
                'imagen.image' => 'El campo Imagen debe ser una imagen',
                'imagen.mimes' => 'El campo Imagen debe ser una imagen de tipo: jpeg,png,jpg,gif,svg',
                'imagen.max' => 'El campo Imagen debe tener máximo 4096 caracteres',
            ];
     }

}
