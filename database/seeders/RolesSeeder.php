<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar datos de prueba en la tabla 'roles'
        DB::table('roles')->insert([
            'name' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Usuario',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Puedes agregar más registros según sea necesario
        DB::table('roles')->insert([
            'name' => 'Otro Rol',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
