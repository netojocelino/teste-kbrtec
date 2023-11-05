<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\State;
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
        $state = State::create([
            "name"       => $this->faker->unique()->citySuffix(),
            "abbr"       => $this->faker->unique()->bothify('#?'),
        ]);

        $city = $state->city()->create([
            "name"       => $this->faker->unique()->city(),
        ]);


        return [
            'code'            => $this->faker->unique()->numerify('camp-#######'),
            'title'           => $this->faker->name(),
            'city_state'      => $this->faker->citySuffix(),
            'city_id'         => $city->id,
            'state_id'        => $state->id,
            'date'            => $this->faker->date('Y-m-d 00:00:00'),
            'about'           => $this->faker->text(),
            'gym_place'       => $this->faker->streetName(),
            'info'            => $this->faker->text(),
            'public_entrance' => $this->faker->text(),
            'type'            => $this->faker->randomElement(['Kimono', 'No-Gi']),
            'phase'           => $this->faker->randomElement(['open_register', 'fighting', 'finished']),
            'active_status'   => $this->faker->boolean(),
        ];
    }
}
