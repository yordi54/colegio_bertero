<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "docentes";
    protected $primaryKey = ['docentes_id', 'geocerca_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function docente() {
        return $this->belongsTo(Docente::class, "docentes_id");
    }

    public function geocercas() {
        return $this->hasMany(Geocerca::class, "geocerca_id");
    }
}
