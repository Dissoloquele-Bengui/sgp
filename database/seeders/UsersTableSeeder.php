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

        // Inserindo o usuário 4
        DB::table('users')->insert([
            'name' => 'Maria Garcia',
            'telefone' => '999999999',
            'perfil' => 'user',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
        ]);

        // Inserindo o usuário 5
        DB::table('users')->insert([
            'name' => 'Daniel Brown',
            'telefone' => '111111111',
            'perfil' => 'user',
            'email' => 'daniel@example.com',
            'password' => Hash::make('password'),
        ]);

        // Inserindo o usuário 6
        DB::table('users')->insert([
            'name' => 'Emily Wilson',
            'telefone' => '222222222',
            'perfil' => 'user',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}