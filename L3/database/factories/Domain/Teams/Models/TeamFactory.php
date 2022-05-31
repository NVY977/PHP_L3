<?php

namespace Database\Factories\Domain\Teams\Models;

use App\Domain\Teams\Models\Team;
use App\Domain\Tournaments\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TeamFactory extends Factory
{
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tournament_id' => Tournament::factory(),
            'title' => $this->faker->title(),
            'color' => $this->faker->colorName(),
            'city' => $this->faker->city(),
        ];
    }
}
