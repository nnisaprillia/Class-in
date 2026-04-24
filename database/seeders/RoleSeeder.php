<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@classin.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@classin.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Instructor Account
        User::updateOrCreate(
            ['email' => 'instructor@classin.com'],
            [
                'name' => 'Instructor',
                'email' => 'instructor@classin.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
            ]
        );

        // Student Account
        User::updateOrCreate(
            ['email' => 'student@classin.com'],
            [
                'name' => 'Student',
                'email' => 'student@classin.com',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );
    }
}