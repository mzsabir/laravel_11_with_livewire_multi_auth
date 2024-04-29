<?php

namespace Database\Factories;
use App\Models\Hearing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hearing>
 */
class HearingFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'case_id'=>1,
        'court'=>fake()->randomElement(['High Court','Supreme Court','Sesion Court']),
        'judge'=> fake()->name(),
        'city'=>fake()->randomElement(['Islamabad','Rawalpindi','Lahore']),
        'comment'=>'',
        'result'=>fake()->randomElement(['Medical Request','Bail Confirmed','Witness Appreance']),
        'hearing_date'=>fake()->dateTimeBetween('1990-01-01', '2023-12-31')->format('Y-m-d'),
        'next_date'=>fake()->dateTimeBetween('2024-05-15', '2024-12-31')->format('Y-m-d'),
        ];
    }
}
