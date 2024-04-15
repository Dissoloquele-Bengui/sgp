<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cursos')->insert([
            'curso' => 'Curso de Laravel',
            'duracao' => '08:00:00', // 8 horas
            'descricao' => 'Aprenda Laravel do básico ao avançado.',
            'id_categoria_curso' => 1, // ID da categoria "Programação"
            'id_user' => 1,
        ]);

        DB::table('cursos')->insert([
            'curso' => 'Curso de Photoshop',
            'duracao' => '06:00:00', // 6 horas
            'descricao' => 'Aprenda a utilizar o Photoshop para edição de imagens.',
            'id_categoria_curso' => 2, // ID da categoria "Design"
            'id_user' => 3,
        ]);
    }
}