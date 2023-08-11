<?php

namespace App\Http\Requests;

use App\Rules\CargaHorariaMateria;
use Illuminate\Foundation\Http\FormRequest;

class StoreMateriaRequest extends FormRequest
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
            'nombre' => 'required|min:4|max:100',
            'carga_horaria' => [ 'required', new CargaHorariaMateria() ]
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.min' => 'El campo Nombre debe tener al menos :min caracteres.',
            'nombre.max' => 'El campo Nombre no puede tener más de :max caracteres.',

            'carga_horaria.required' => 'El campo Carga horaria es obligatorio',
        ];
    }
}
