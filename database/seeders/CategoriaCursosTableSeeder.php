<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriaCursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categoria_cursos')->insert([
            'categoria' => 'Programação',
        ]);

        DB::table('categoria_cursos')->insert([
            'categoria' => 'Design',
        ]);
    }
}
