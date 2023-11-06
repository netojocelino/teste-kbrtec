<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetitorGroups>
 */
class CompetitorGroupsFactory extends Factory
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
            'match_number'    => $this->faker->randomNumber(),

            // 'championship_id'   => '',
            // 'first_athlete_id'  => '',
            // 'second_athlete_id' => '',
            // 'winner_athlete_id' => '',
        ];
    }
}
