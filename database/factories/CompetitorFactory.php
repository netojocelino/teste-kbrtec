<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competitor>
 */
class CompetitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'belt'            => $this->faker->randomElement(['black', 'brown']),
            'weight'          => $this->faker->randomElement(['light', 'strong']),
            'team'            => $this->faker->name(),
            // "championship_id" => $this->faker->name(),
            // "athlete_id"      => $this->faker->name(),
        ];
    }
}
