<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CreateHorarioForMateriaUniqueData implements Rule
{
    private $aula_nro;
    private $dia_id;
    private $hora_id;

    public function __construct($aula_nro, $dia_id, $hora_id){
        $this->aula_nro = $aula_nro;
        $this->dia_id = $dia_id;
        $this->hora_id = $hora_id;
    }

    public function passes($attribute, $value)
    {
        $sql = "select *
                from horarios
                where
                aulas_nro = ? and
                dias_id = ? and
                horas_id = ?
                ";
        $gradoMateria = DB::select($sql, [$this->aula_nro, $this->dia_id, $this->hora_id]);
        
        if(count($gradoMateria) === 0) return true;
        return false;
        
    }

    public function message()
    {
        return 'Aula, Dia u Horario ya asignado, verifique sus campos.';
    }
}
