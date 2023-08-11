<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class CargaHorariaMateria implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        // expresión regular para el formato específico ej: 40 min/día
        $pattern = "/^\d+ min\/día$/";

        // Verificar si el valor coincide con el formato específico
        return preg_match($pattern, $value) === 1;
    }

    public function message()
    {
        return 'El campo debe tener el formato "número min/día".';
    }
}
