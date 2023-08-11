<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuntaEscolarGrado extends Model
{
    use HasFactory;
    protected $table = "junta_grados";
    protected $primaryKey = ['junta_escolar_id', 'grados_id'];
    public $incrementing = false;
    public $timestamps = false;
}
