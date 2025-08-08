<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('types')->insert([
            ['id' => 1, 'nama' => 'Text', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama' => 'Gambar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}