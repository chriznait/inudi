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
}
