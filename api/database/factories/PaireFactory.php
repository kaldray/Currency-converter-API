<?php

namespace Database\Factories;

use App\Models\Devise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paire>
 */
class PaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "from" => Devise::factory()->create()->name,
            "to" => Devise::factory()->create()->name,
            "convertion_rate" => fake()->randomFloat(2, 0, 10),
            "convertion_number" => fake()->randomDigitNotNull(),
        ];
    }
}
