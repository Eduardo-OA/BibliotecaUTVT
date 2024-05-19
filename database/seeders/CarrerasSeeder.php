<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Mantenimiento, Área Industrial',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Mecatrónica, Área Sistermas Manufactura Flexible',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Procesos Industriales, Área Manufactura',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Química, Área Tecnología Ambiental',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Química, Área Biotecnología',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Procesos Alimentarios',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Paramédico',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Desarrollo de Negocios, Área Ventas',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'T.S.U Desarrollo de Negocios, Área Mercadotecnica',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Mantenimiento Industrial',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Mecatrónica',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Desarrollo y Gestión de Software',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Redes Inteligentes y Ciberseguridad',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Sistemas Productivos',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Tecnología Ambiental',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Biotecnología',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'ING. Procesos Bioalimentarios',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'LIC. Protección Civil y Emergencias',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'LIC. Innovación de Negocios y Mercadotecnica',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
