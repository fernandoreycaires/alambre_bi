<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvataresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar2.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar3.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar4.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar5.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar6.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar7.png',
        ]);
        Avatar::create([
            'url'=>'AdminLTE/dist/img/avatar8.png',
        ]);
    }
}
