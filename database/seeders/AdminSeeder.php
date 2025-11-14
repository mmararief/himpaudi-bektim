<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'username' => 'admin',
            'email' => 'admin@himpaudi-bektim.org',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        \App\Models\User::create([
            'username' => 'pengurus',
            'email' => 'pengurus@himpaudi-bektim.org',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
