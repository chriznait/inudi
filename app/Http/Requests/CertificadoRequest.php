<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificadoRequest extends FormRequest
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
            'nroDocumento' => 'required|numeric',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|numeric',
            'profesion' => 'required|string',
            'gradoAcademico' => 'required|string',
            'idPais' => 'required|numeric',
            'idDepartamento' => 'required|numeric',
            'idProvincia' => 'required|numeric',
            'idDistrito' => 'required|numeric',
            'montoPagado' => 'required',
            'fechaPago' => 'required',
        ];
    }
    public function messages(){
        return [
            'nroDocumento.required' => 'El campo Nro. Documento es obligatorio',
            'nroDocumento.numeric' => 'El campo Nro. Documento debe ser numérico',
            'nombre.required' => 'El campo Nombre es obligatorio',
            'nombre.string' => 'El campo Nombre debe ser texto',
            'apellido.required' => 'El campo Apellido es obligatorio',
            'apellido.string' => 'El campo Apellido debe ser texto',
            'email.required' => 'El campo Email es obligatorio',
            'email.email' => 'El campo Email debe ser un email válido',
            'telefono.required' => 'El campo Teléfono es obligatorio',
            'telefono.numeric' => 'El campo Teléfono debe ser numérico',
            'profesion.required' => 'El campo Profesión es obligatorio',
            'profesion.string' => 'El campo Profesión debe ser texto',
            'gradoAcademico.required' => 'El campo Grado Académico es obligatorio',
            'gradoAcademico.string' => 'El campo Grado Académico debe ser texto',
            'idPais.required' => 'El campo País es obligatorio',
            'idDepartamento.required' => 'El campo Departamento es obligatorio',
            'idProvincia.required' => 'El campo Provincia es obligatorio',
            'idDistrito.required' => 'El campo Distrito es obligatorio',
            'montoPagado.required' => 'El campo Monto Pagado es obligatorio',
            'fechaPago.required' => 'El campo Fecha de Pago es obligatorio',
        ];
    }

}
