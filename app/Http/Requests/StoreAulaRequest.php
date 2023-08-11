<?php

namespace App\Http\Requests;

use App\Rules\CreateAulaUniqueData;
use Illuminate\Foundation\Http\FormRequest;

class StoreAulaRequest extends FormRequest
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
            'nro' => [ 'required', 'numeric', new CreateAulaUniqueData() ],
            'capacidad' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nro.required' => 'El campo Nro es obligatorio.',
            'nro.numeric' => 'El campo Nro debe ser entero',

            'capacidad.required' => 'El campo Capacidad es obligatorio.',
            'capacidad.numeric' => 'El campo Capacidad debe ser entero',
        ];
    }
}
