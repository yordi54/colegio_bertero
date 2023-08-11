<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueData implements Rule
{
    protected $table;
    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        $sql = "select *
                from personas
                where
                LOWER(TRIM(ci)) = ? or
                LOWER(TRIM(telefono)) = ? or
                LOWER(TRIM(email)) = ?;
                ";
        $personas = DB::select($sql, [$value, $value, $value]);
        
        if(count($personas) === 0) return true;
        return false;
        
    }

    public function message()
    {
        return 'Este campo ya existe en la base de datos.';
    }
}