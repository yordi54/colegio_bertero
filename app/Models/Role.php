<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ["nombre"];
    protected $table = "roles";
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public function personas() {
        return $this->belongsToMany(Persona::class, "personas_roles", "roles_id", "personas_id")->withPivot("estado_activo");
    }

    public function permisos() {
        return $this->belongsToMany(Permiso::class, "roles_permisos", "roles_id", "permisos_id");
    }

    public function users() {
        return $this->belongsToMany(User::class, "personas_roles", "roles_id", "personas_id")->withPivot("estado_activo");
    }
}
