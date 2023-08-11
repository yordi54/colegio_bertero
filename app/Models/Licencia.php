<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;
    protected $table = "licencias";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function docente() {
        return $this->belongsTo(Docente::class, "docentes_id");
    }
}
