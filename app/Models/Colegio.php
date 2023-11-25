<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    use HasFactory;
    protected $fillable = [
        'docentes_id',
        'geocerca_id',
    ];

    public function docente() {
        return $this->belongsTo(Docente::class, "docentes_id");
    }

    public function geocerca() {
        return $this->belongsTo(Geocerca::class, "geocerca_id");
    }
}
