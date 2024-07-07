<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = \App\Models\Category::insert([
            [
                'id' => 1,
                'namaKategori' => 'SMA',
                'descKategori' => 'Jenjang sekolah menengah atas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'namaKategori' => 'SMP',
                'descKategori' => 'Jenjang sekolah menengah pertama',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'namaKategori' => 'SD',
                'descKategori' => 'Jenjang sekolah dasar',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
