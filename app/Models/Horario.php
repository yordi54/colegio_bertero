<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = "horarios";
    // protected $primaryKey = "['id', 'grados_materias_id']";
    protected $primaryKey = "id";
    // public $incrementing = false;
    public $timestamps = false;

    public function grado_materia() {
        return $this->belongsTo(GradoMateria::class, "grados_materias_id");
    }

    public function aula() {
        return $this->belongsTo(Aula::class, "aulas_nro");
    }

    public function dia() {
        return $this->belongsTo(Dia::class, "dias_id");
    }

    public function hora() {
        return $this->belongsTo(Hora::class, "horas_id");
    }
}
