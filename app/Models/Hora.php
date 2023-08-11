<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ["hora_ini", "hora_fin"];
    protected $table = "horas";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function horarios() {
        return $this->hasMany(Horario::class, "horas_id");
    }
}
