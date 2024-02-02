<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar datos de prueba en la tabla 'users'
    
        //intyeccion
        DB::table('users')->insert([
            'name' => 'Administrador',
            'app' => '_',
            'apm' => 'ADMIN',
            'carrera' => 'Carrera1',
            'matricula' => 123456,
            'direccion' => 'barcelona city',
            'genero' => 'Masculino',
            'email' => 'admin@biblioteca.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'rol_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
