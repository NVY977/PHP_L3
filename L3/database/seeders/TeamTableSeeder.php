<?php

namespace Database\Seeders;

use App\Domain\Players\Models\Player;
use App\Domain\Teams\Models\Team;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        Team::factory()
            ->count(3)
            ->has(Player::factory()->count(11), 'teams')
            ->create();
    }
}
