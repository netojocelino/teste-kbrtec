<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Championship>
 */
class ChampionshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'            => $this->faker->unique()->numerify('camp-#######'),
            'title'           => $this->faker->name(),
            'city_state'      => $this->faker->citySuffix(),
            'date'            => $this->faker->date('Y-m-d 00:00:00'),
            'about'           => $this->faker->text(),
            'gym_place'       => $this->faker->streetName(),
            'info'            => $this->faker->text(),
            'public_entrance' => $this->faker->text(),
            'type'            => $this->faker->randomElement(['Kimono', 'No-Gi']),
            'phase'           => $this->faker->randomElement(['Inscrições Abertas', 'Chaves de Lutas', 'Resultados']),
            'active_status'   => $this->faker->boolean(),
        ];
    }
}
