<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear datos de ejemplo para la tabla libros
        Libro::create([
            'titulo' => 'El nombre del viento',
            'autor_principal' => 'Patrick Rothfuss',
            'genero' => 'Fantasía',
            'editorial' => 'Plaza & Janés',
            'idioma' => 'Español',
            'cantidad' => 10,
            'disponibilidad' => true,
            'ubicacion' => 'A-1',
            'fechaadqui' => now(), // Utiliza la función now() para obtener la fecha actual
        ]);

        // Puedes agregar más datos de ejemplo si lo deseas
    }
}
