<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CreateGradoMateriaUniqueData implements Rule
{

    private $grado_id;
    private $materia_id;

    public function __construct($grado_id, $materia_id){
        $this->grado_id = $grado_id;
        $this->materia_id = $materia_id;
    }

    public function passes($attribute, $value)
    {
        $sql = "select *
                from grados_materias
                where grados_id = ? and materias_id = ?
                ";
        $gradoMateria = DB::select($sql, [$this->grado_id, $this->materia_id]);
        
        if(count($gradoMateria) === 0) return true;
        return false;
        
    }

    public function message()
    {
        return 'Campo ya asignado a un docente.';
    }
}
