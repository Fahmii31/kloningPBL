<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Nasrul', 'email' => 'nasrul@gmail.com', 'role' => 'pembeli', 'status' => 'active', 'password' => 'nasrul']);
        User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'role' => 'admin', 'status' => 'active', 'password' => 'admin']);
    }
}
