<?php

namespace Database\Seeders;

use App\Domain\Players\Models\Player;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        Player::factory()->count(10)->create();
    }
}
