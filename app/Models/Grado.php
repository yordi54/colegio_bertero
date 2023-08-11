<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $fillable = ["nombre"];
    protected $table = "grados";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function juntas_escolares() {
        return $this->belongsToMany(JuntaEscolar::class, "junta_grados", "grados_id", "junta_escolar_id");
    }

    public function grados_materias() {
        return $this->hasMany(GradoMateria::class, "grados_id");
    }
}
