<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perfil::create([
            'id'=>'99308315-7b85-4f99-a0ee-30e7037f91a5',
            'id_catalogo' => '99307e4c-76b4-42f8-8ae3-e9f919c38c29',
            'id_user' => '99306822-2738-4b9a-9c36-359a339b5952',
        ]);
    }
}
