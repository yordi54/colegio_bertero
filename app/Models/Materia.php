<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ["nombre", "carga_horaria"];
    protected $table = "materias";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function grados_materias() {
        return $this->hasMany(GradoMateria::class, "materias_id");
    }
}
