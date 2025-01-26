<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Create a normal user
        User::create([
            'name' => 'User',
            'email' => 'user@domain.com',
            'password' => Hash::make('12345678'), // Hash the password
            'role' => 'user', // If applicable, mark this user as not an admin
        ]);
    }
}
