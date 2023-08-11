<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PersonaUniqueData implements Rule
{
    private $message = "";

    public function passes($attribute, $value)
    {
        $sql = "select *
                from personas
                where
                ci = ?
                ";
        $persona = DB::select($sql, [$value]);
        
        if(count($persona) === 1) {
            $sqlDocente = "select *
                            from docentes
                            where
                            personas_id = ?
                            ";
            $docente = DB::select($sqlDocente, [$persona[0]->id]);
            if(count($docente) === 1) {
                return true;
            }
            $this->message = 'La persona no es un docente.';
            return false;
        };
        $this->message = 'No existe el docente.';
        return false;
        
    }

    public function message()
    {
        return $this->message;
    }
}
