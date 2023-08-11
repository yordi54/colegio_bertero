<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJEscolarRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombres' => 'required|min:4|max:100',
            'apellidos' => 'required|min:4|max:100',
            'telefono' => 'required|min:8|max:8',
            'sexo' => 'required|in:M,F',
            'estado_activo' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'El campo Nombres es obligatorio.',
            'nombres.min' => 'El campo Nombres debe tener al menos :min caracteres.',
            'nombres.max' => 'El campo Nombres no puede tener más de :max caracteres.',
            'apellidos.required' => 'El campo Apellidos es obligatorio.',
            'apellidos.min' => 'El campo Apellidos debe tener al menos :min caracteres.',
            'apellidos.max' => 'El campo Apellidos no puede tener más de :max caracteres.',
            'telefono.required' => 'El campo Teléfono es obligatorio.',
            'telefono.min' => 'El campo Teléfono debe tener :min caracteres.',
            'telefono.max' => 'El campo Teléfono debe tener :max caracteres.',
            'sexo.required' => 'Selecciona el Sexo.',
            'sexo.in' => 'El valor seleccionado para el Sexo es inválido.',
            'estado_activo.required' => 'Selecciona el Estado Activo.',
            'estado_activo.in' => 'El valor seleccionado para el Estado Activo es inválido.',
        ];
    }
}
