<?php

namespace Database\Factories\Domain\Tournaments\Models;

use App\Domain\Tournaments\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TournamentFactory extends Factory
{
    protected $model = Tournament::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'prize' => $this->faker->numberBetween(100000, 1000000),
            'city' => $this->faker->city(),
        ];
    }
}
