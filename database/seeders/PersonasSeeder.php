<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\PersonaRole;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persona = new Persona();
        $persona->ci = "988321";
        $persona->nombres = "Joaquin";
        $persona->apellidos = "Chumacero Mamani";
        $persona->telefono = "79867879";
        $persona->direccion = "Las Lomas 1";
        $persona->sexo = "M";
        $persona->email = "admin@gmail.com";
        $persona->password = bcrypt("123456");
        $persona->save();

        $fechaActual = Carbon::now();
        $personaRole = new PersonaRole();
        $personaRole->personas_id = $persona->id;
        $personaRole->roles_id = 2;
        $personaRole->estado_activo = true;
        $personaRole->fecha_asignacion = $fechaActual;
        $personaRole->save();
    }
}
