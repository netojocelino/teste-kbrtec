<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Athlete>
 */
class AthleteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'            => $this->faker->unique()->slug(),
            'full_name'       => $this->faker->name(),
            'birthdate'       => $this->faker->date(),
            'document_number' => $this->faker->numerify('###.###.###-##'),
            'team'            => $this->faker->name(),
            'gender'          => $this->faker->randomElement(['male', 'female']),
            'belt'            => $this->faker->randomElement(['black', 'brown']),
            'weight'          => $this->faker->randomElement(['light', 'strong']),
            'email'           => $this->faker->unique()->email(),
            'password'        => $this->faker->words(3, true),
        ];
    }
}
