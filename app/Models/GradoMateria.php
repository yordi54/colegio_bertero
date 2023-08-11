<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoMateria extends Model
{
    use HasFactory;
    protected $table = "grados_materias";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function docente() {
        return $this->belongsTo(Docente::class, "docentes_id");
    }

    public function materia() {
        return $this->belongsTo(Materia::class, "materias_id");
    }

    public function grado() {
        return $this->belongsTo(Grado::class, "grados_id");
    }

    public function horarios() {
        return $this->hasMany(Horario::class, "grados_materias_id");
    }
}
