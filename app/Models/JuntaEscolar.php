<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuntaEscolar extends Model
{
    use HasFactory;
    protected $guarded = ["grado"];
    protected $table = "junta_escolar";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function grados() {
        return $this->belongsToMany(Grado::class, "junta_grados", "junta_escolar_id", "grados_id");
    }
}
