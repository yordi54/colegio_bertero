<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CreateAulaUniqueData implements Rule
{
    public function passes($attribute, $value)
    {
        $sql = "select *
                from aulas
                where
                nro = ?
                ";
        $aulas = DB::select($sql, [$value]);
        
        if(count($aulas) === 0) return true;
        return false;
        
    }

    public function message()
    {
        return 'Este campo ya existe en la base de datos.';
    }
}
