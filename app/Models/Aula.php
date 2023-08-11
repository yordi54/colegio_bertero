<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $fillable = ["nro", "capacidad"];
    protected $table = "aulas";
    protected $primaryKey = 'nro';
    public $incrementing = false;
    public $timestamps = false;

    public function horarios() {
        return $this->hasMany(Horario::class, "aulas_nro");
    }
}
