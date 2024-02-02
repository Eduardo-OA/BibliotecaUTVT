<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar datos de prueba en la tabla 'users'
    
        //intyeccion
        DB::table('users')->insert([
            'nombre' => 'Administrador',
            'app' => '',
            'apm' => '',
            'carrera' => 'UTVT',
            'matricula' => 123456,
            'direccion' => 'Lerma México',
            'genero' => 'M',
            'email' => 'admin@biblioteca.com',
            'password' => Hash::make('admin'),
            'rol_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
