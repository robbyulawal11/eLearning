<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@sikanda.store',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'image' => '300-1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
