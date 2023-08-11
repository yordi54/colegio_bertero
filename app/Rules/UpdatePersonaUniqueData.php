<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UpdatePersonaUniqueData implements Rule
{
    private $persona;
    private $column;
    public function __construct($persona, $column)
    {
        $this->persona = $persona;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {

        // if($this->unaPasada){
        //     $sql = "select *
        //         from personas
        //         where
        //         LOWER(TRIM(ci)) = ?;
        //         ";
        //     $this->personas = DB::select($sql, [$value]);
            
        // }
        
        if( $this->column === 'telefono'){
            if(trim(strtolower($this->persona->telefono)) !== trim(strtolower($value))){
                $sql = "select *
                        from personas
                        where
                        LOWER(TRIM(telefono)) = ?
                        ";
                $persona = DB::select($sql, [$value]);
                if(count($persona) === 0) return true;
                return false;
            }
            return true;
        }

        // if($this->column === 'email') {
        //     if(trim(strtolower($this->persona->email)) !== trim(strtolower($value))){
        //         $sql = "select *
        //                 from personas
        //                 where
        //                 LOWER(TRIM(email)) = ?
        //                 ";
        //         $persona = DB::select($sql, [$value]);
        //         if(count($persona) === 0) return true;
        //         return false;
        //     }
        //     return true;
        // }
        
    }

    public function message()
    {
        return 'Este campo ya existe en la base de datos.';
    }
}
