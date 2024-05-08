<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'telefone' => '123456789',
            'perfil' => 'admin',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);


         // Inserindo o usuário 2
         DB::table('users')->insert([
            'name' => 'Jane Smith',
            'telefone' => '987654321',
            'perfil' => 'user',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);

        // Inserindo o usuário 3
        DB::table('users')->insert([
            'name' => 'Michael Johnson',
            'telefone' => '555555555',
            'perfil' => 'user',
            'email' => 'michael@example.com',
            'password' => Hash::make('password'),
        ]);

    }
}
