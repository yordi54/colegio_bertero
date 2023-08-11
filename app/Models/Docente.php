<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = "docentes";
    protected $primaryKey = 'personas_id';
    public $incrementing = false;
    public $timestamps = false;

    public function persona() {
        return $this->belongsTo(Persona::class, "personas_id");
    }

    public function grados_materias() {
        return $this->hasMany(GradoMateria::class, "docentes_id");
    }

    public function faltas() {
        return $this->hasMany(Falta::class, "docentes_id");
    }

    public function licencias() {
        return $this->hasMany(Licencia::class, "docentes_id");
    }

    public function asistencias() {
        return $this->hasMany(Asistencia::class, "docentes_id");
    }

    public function user() {
        return $this->belongsTo(User::class, "personas_id");
    }
}
