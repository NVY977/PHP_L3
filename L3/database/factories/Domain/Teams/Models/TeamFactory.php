<?php

namespace Database\Factories\Domain\Teams\Models;

use App\Domain\Teams\Models\Team;
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
            'title' => $this->faker->title(),
            'color' => $this->faker->colorName(),
            'city' => $this->faker->city(),
        ];
    }
}
