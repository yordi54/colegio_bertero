<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaRole extends Model
{
    use HasFactory;
    protected $table = "personas_roles";
    protected $primaryKey = ['personas_id', 'roles_id'];
    public $incrementing = false;
    public $timestamps = false;

}
