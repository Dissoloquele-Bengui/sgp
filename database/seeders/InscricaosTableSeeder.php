<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InscricaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('inscricaos')->insert([
                'id_user' => $i, // IDs dos primeiros 5 usuários criados
                'id_curso' => 1, // ID do curso "Curso de Laravel"
            ]);
        }

        // Adicionando inscrições para o Curso de Photoshop (ID: 2)
        for ($i = 1; $i <= 3; $i++) {
            DB::table('inscricaos')->insert([
                'id_user' => $i, // IDs dos últimos 5 usuários criados
                'id_curso' => 2, // ID do curso "Curso de Photoshop"
            ]);
        }
        //
    }
}
