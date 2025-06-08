<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin123@gmail.com'], // email sebagai primary key unik
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),  // password yang kamu inginkan
                'role' => 'admin',
                'status' => 'active',
            ]
        );
    }
}
