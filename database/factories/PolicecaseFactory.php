<?php

namespace Database\Factories;

use App\Models\Policecase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Policecase>
 */
class PolicecaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [            
            'title'=> Str::random(10),
            'act'=> Str::random(5),
            'slug'=> Str::random(10),
            'client_id'=>1,
            'lawyer_id'=>2,
            'status'=>fake()->randomElement(['pending','in progress','completed']),
        ];
    }
}
