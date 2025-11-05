<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '99306822-2738-4b9a-9c36-359a339b5952',
            'name' => 'Senhor Supremo das Galaxias',
            'email' => 'senhor_das_galaxias@nasa.org',
            'password' => Hash::make('senhordasgalaxias123'),
            'status' => 'Ativo',
            'email_verified_at' => '2022-06-22 19:41:35.000',
        ]);

        User::create([
            'name' => 'Carlos Alberto do Teste',
            'email' => 'carlos.teste@gmail.com',
            'password' => Hash::make('carlosTeste123'),
            'status' => 'Ativo',
            'email_verified_at' => '2022-06-22 19:41:35.000',
        ]);

        User::create([
            'name' => 'Joaquina Ferraz da Luz',
            'email' => 'joaquina.luz@gmail.com',
            'password' => Hash::make('joaquinaLuz123'),
            'status' => 'Ativo',
            'email_verified_at' => '2022-06-22 19:41:35.000',
        ]);

        
    }
}
