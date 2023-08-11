<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ["nombre"];
    protected $table = "dias";
    protected $primaryKey = 'id';
    // public $incrementing = false;
    public $timestamps = false;

    public function horarios() {
        return $this->hasMany(Horario::class, "dias_id");
    }
}
