<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredRequest extends FormRequest
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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
            'montoPagado' => 'required',
            'fechaPago' => 'required',
        ];
        
    }
    public function messages(){
        return [
            'nombre.required' => 'El campo Nombre es obligatorio',
            'nombre.string' => 'El campo Nombre debe ser texto',
            'apellido.required' => 'El campo Apellido es obligatorio',
            'apellido.string' => 'El campo Apellido debe ser texto',
            'email.required' => 'El campo Email es obligatorio',
            'email.email' => 'El campo Email debe ser un email válido',
            'montoPagado.required' => 'El campo Monto Pagado es obligatorio',
            'fechaPago.required' => 'El campo Fecha de Pago es obligatorio',
        ];
    }
}
