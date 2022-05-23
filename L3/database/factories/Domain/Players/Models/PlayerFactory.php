<?php

namespace Database\Factories\Domain\Players\Models;

use App\Domain\Players\Models\Player;
use App\Domain\Teams\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PlayerFactory extends Factory
{
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'name' => $this->faker->firstNameMale(),
            'lastname' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(0, 40),
            'city' => $this->faker->city(),
        ];
    }
}
