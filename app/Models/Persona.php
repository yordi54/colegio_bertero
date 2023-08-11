<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = ["ci", "nombres", "apellidos", "telefono", "direccion", "sexo", "email", "password"];

    protected $table = "personas";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;


    public function docente() {
        return $this->hasOne(Docente::class, "personas_id");
    }

    public function roles() {
        return $this->belongsToMany(Role::class, "personas_roles", "personas_id", "roles_id")->withPivot("estado_activo");
    }
}
