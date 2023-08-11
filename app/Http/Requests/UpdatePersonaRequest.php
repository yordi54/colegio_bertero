<?php

namespace App\Http\Requests;

use App\Rules\UpdatePersonaUniqueData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class UpdatePersonaRequest extends FormRequest
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
        $persona = DB::table("personas")->where("ci", $this->input("ci"))->get()[0];
        return [
            'nombres' => 'required|min:3|max:80',
            'apellidos' => 'required|min:5|max:80',
            'telefono' => [ 'required', 'numeric', 'digits:8', new UpdatePersonaUniqueData($persona, "telefono") ],
            'direccion' => 'required|min:3',
            // 'email' => [ 'required', 'email', new UpdatePersonaUniqueData($persona, "email") ],
            // 'password' => 'required|min:4',
            'role' => 'required',
            'estado_activo' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'ci.required' => 'El campo CI es obligatorio.',
            'ci.numeric' => 'El campo CI debe ser numérico.',
            'ci.min' => 'El campo CI debe tener al menos :min caracteres.',
            'ci.max' => 'El campo CI no debe tener más de :max caracteres.',
            
            'nombres.required' => 'El campo Nombres es obligatorio.',
            'nombres.min' => 'El campo Nombres debe tener al menos :min caracteres.',
            'nombres.max' => 'El campo Nombres no debe tener más de :max caracteres.',
            
            'apellidos.required' => 'El campo Apellidos es obligatorio.',
            'apellidos.min' => 'El campo Apellidos debe tener al menos :min caracteres.',
            'apellidos.max' => 'El campo Apellidos no debe tener más de :max caracteres.',
            
            'telefono.required' => 'El campo Teléfono es obligatorio.',
            'telefono.numeric' => 'El campo Teléfono debe ser numérico.',
            'telefono.digits' => 'El campo Teléfono debe tener :digits dígitos.',
            
            'direccion.required' => 'El campo Dirección es obligatorio.',
            'direccion.min' => 'El campo Dirección debe tener al menos :min caracteres.',
            
            // 'email.required' => 'El campo Email es obligatorio.',
            // 'email.email' => 'El campo Email debe ser una dirección de correo válida.',
            
            // 'password.required' => 'El campo Contraseña es obligatorio.',
            // 'password.min' => 'El campo Contraseña debe tener al menos :min caracteres.',

            'role.required' => 'El campo Role es obligatorio.',

            'estado_activo.required' => 'Selecciona el Estado Activo.',
            'estado_activo.in' => 'El valor seleccionado para el Estado Activo es inválido.',
        ];
    }
}
