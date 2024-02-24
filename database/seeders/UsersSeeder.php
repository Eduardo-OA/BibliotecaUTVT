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

        DB::table('users')->insert([
            'nombre' => 'Auxiliar',
            'app' => '-',
            'apm' => 'Biblioteca',
            'genero' => 'M',
            'email' => 'auxiliar@biblioteca.com',
            'password' => Hash::make('auxiliar'),
            'rol_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nombre' => 'Miguel Emanuel',
            'app' => 'Arriola',
            'apm' => 'Ortega',
            'carrera' => 'UTVT',
            'matricula' => 123456,
            'direccion' => 'Xonacatlan, Edo. de México',
            'genero' => 'H',
            'rol_id' => 3, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nombre' => 'Jimena',
            'app' => 'Diaz',
            'apm' => 'de los Santos',
            'carrera' => 'UTVT',
            'matricula' => 123456,
            'direccion' => 'Xonacatlan, Edo. de México',
            'genero' => 'H',
            'rol_id' => 3, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
