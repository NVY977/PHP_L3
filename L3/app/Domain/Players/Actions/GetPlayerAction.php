<?php

namespace App\Domain\Players\Actions;

use App\Domain\Players\Models\Player;

class GetPlayerAction
{
    public function execute(int $id): Player
    {
        return Player::findOrFail($id);
    }
}
