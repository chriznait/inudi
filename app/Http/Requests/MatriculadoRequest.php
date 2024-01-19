<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculadoRequest extends FormRequest
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
            'imgCertificado' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

        ];
    }

    public function messages(){
        return [
            'imgCertificado.required' => 'El campo Certificado es obligatorio',
            'imgCertificado.image' => 'El campo Certificado debe ser una imagen',
            'imgCertificado.mimes' => 'El campo Certificado debe ser una imagen de tipo: jpeg,png,jpg,gif,svg',
            'imgCertificado.max' => 'El campo Certificado debe ser una imagen de tamaño máximo 4MB',
        ];
    }

}
