<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->count(50)->create();
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'client@gmail.com',
            'role'=>'client',
        ]);

        User::factory()->create([
            'name' => 'Zeeshan Sabir',
            'email' => 'mzsabir@gmail.com',
            'role'=>'lawyer',
        ]);
    }
}
