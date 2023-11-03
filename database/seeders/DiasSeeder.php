<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        
        foreach($dias as $dia){
            $diam = new Dia();
            $diam->nombre = $dia;
            $diam->save();
        }

    }
}
