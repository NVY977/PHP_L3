<?php

namespace App\Domain\Players\Actions;

use App\Domain\Players\Models\Player;

class GetAllPlayersAction
{
    public function execute(): array
    {
        return Player::all()->toArray();
    }
}
