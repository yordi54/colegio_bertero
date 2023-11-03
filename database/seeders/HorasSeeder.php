<?php

namespace Database\Seeders;

use App\Models\Hora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horasIni = array("07:30", "08:15", "09:15", "10:00", "11:00", "11:45");
        $horasFin = array("08:15", "08:55", "10:00", "10:40", "11:45", "12:30");

        for($horaI = 0; $horaI < count($horasIni); $horaI++){
            $hora = new Hora();
            $hora->hora_ini = $horasIni[$horaI];
            $hora->hora_fin = $horasFin[$horaI];
            $hora->save();
        }
    }
}
