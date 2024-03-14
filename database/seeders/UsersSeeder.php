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
        // Carreras disponibles
        $carreras = [
            "T.S.U Mantenimiento, Área industrial",
            "T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.",
            "T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.",
            "T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.",
            "T.S.U Procesos Industriales, Área Manufactura.",
            "T.S.U Química, Área Tecnología Ambiental.",
            "T.S.U Paramédico.",
            "T.S.U Desarrollo de Negocios, Área Ventas.",
            "T.S.U Desarrollo de Negocios, Área Mercadotecnica.",
            "ING. Mantenimiento Industrial.",
            "ING. Mecatrónica",
            "ING. Desarrollo y Gestión de Software.",
            "ING. Redes Inteligentes y Ciberseguridad",
            "ING. Sistemas Productivos.",
            "ING. Tecnología Ambiental.",
            "LIC. Protección Civil y Emergencias.",
            "LIC. Innovación de Negocios y Mercadotecnica.",
            "LIC. Enfermería"
        ];

        $x = 1; // Inicializamos $x aquí
        foreach ($carreras as $carrera) {
            // Insertar 3 usuarios por cada carrera
            for ($i = 0; $i < 3; $i++) {
                DB::table('users')->insert([
                    'nombre' => 'Usuario ' . ($x),
                    'app' => 'Apellido',
                    'apm' => 'Apellido',
                    'carrera' => $carrera,
                    'matricula' => rand(100000, 999999), // Generar una matrícula aleatoria
                    'direccion' => 'Dirección de prueba',
                    'genero' => 'M', // O ajusta según corresponda
                    'email' => 'usuario' . $x . '@biblioteca.com', // Cambiar el dominio si es necesario
                    'password' => Hash::make('123456'), // Cambiar la contraseña si es necesario
                    'rol_id' => 3, // Rol de usuario común
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $x++; // Incrementamos $x aquí
            }
        }


    }
}

// class UsersSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         // Insertar datos de prueba en la tabla 'users'

//         //intyeccion
//         DB::table('users')->insert([
//             'nombre' => 'Administrador',
//             'app' => '',
//             'apm' => '',
//             'carrera' => 'UTVT',
//             'matricula' => 123456,
//             'direccion' => 'Lerma México',
//             'genero' => 'M',
//             'email' => 'admin@biblioteca.com',
//             'password' => Hash::make('admin'),
//             'rol_id' => 1,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);

//         DB::table('users')->insert([
//             'nombre' => 'Auxiliar',
//             'app' => '-',
//             'apm' => 'Biblioteca',
//             'genero' => 'M',
//             'email' => 'auxiliar@biblioteca.com',
//             'password' => Hash::make('auxiliar'),
//             'rol_id' => 2,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);

//         DB::table('users')->insert([
//             'nombre' => 'Miguel Emanuel',
//             'app' => 'Arriola',
//             'apm' => 'Ortega',
//             'carrera' => 'UTVT',
//             'matricula' => 123456,
//             'direccion' => 'Xonacatlan, Edo. de México',
//             'genero' => 'H',
//             'rol_id' => 3,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);

//         DB::table('users')->insert([
//             'nombre' => 'Jimena',
//             'app' => 'Diaz',
//             'apm' => 'de los Santos',
//             'carrera' => 'UTVT',
//             'matricula' => 123456,
//             'direccion' => 'Xonacatlan, Edo. de México',
//             'genero' => 'H',
//             'rol_id' => 3,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
// }
