<?php

namespace Database\Seeders;

use App\Models\Hearing;
use App\Models\User;
use App\Models\Policecase;

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
        
        
        User::factory()->create([
            'id'=>1,
            'name' => 'Hassan Rasheed',
            'email' => 'hassan@gmail.com',
            'role'=>'client',
            'picture'=>'hassan.jpg',
        ]);

        User::factory()->create([
            'id'=>2,
            'name' => 'Zohaib Bhervi',
            'email' => 'zohaib@gmail.com',
            'role'=>'lawyer',
            'picture'=>'zohaib.jpg',
        ]);

        User::factory()->create([
            'id'=>3,
            'name' => 'Ali haider Khan',
            'email' => 'ali@gmail.com',
            'role'=>'admin',
            'picture'=>'ali.jpg',
        ]);

        User::factory()->count(20)->create();
       /* Policecase::factory()->count(10)->create();
        for($i=1;$i<=10;$i++){
            Hearing::factory()->create([
                'case_id'=>$i                
            ]);
        } */
        
        
    }
}
