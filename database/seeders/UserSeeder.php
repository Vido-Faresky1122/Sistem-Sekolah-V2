<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Arianto', 'email' => 'arianto@gmail.com', 'password' => bcrypt('admin123'), 'role' => 'teacher'],
            ['name' => 'Vido Faresky', 'email' => 'vidofaresky@gmail.com', 'password' => bcrypt('password123'), 'role' => 'student'],
        ];

        User::upsert($users, ['email'], ['name', 'password', 'role']);
    }
}
