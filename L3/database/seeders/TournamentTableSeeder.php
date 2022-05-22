<?php

namespace Database\Seeders;

use App\Domain\Players\Models\Player;
use App\Domain\Teams\Models\Team;
use App\Domain\Tournaments\Models\Tournament;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TournamentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        Tournament::factory()
            ->count(3)
            ->has(Team::factory()->count(8)
                ->has(Player::factory()->count(11), 'player'), 'team')
            ->create();
    }
}
