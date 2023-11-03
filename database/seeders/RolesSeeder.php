<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role();
        $role->nombre = "Docente";
        $role->save();

        $role = new Role();
        $role->nombre = "Secretario";
        $role->save();
    }
}
