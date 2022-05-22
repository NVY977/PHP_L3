<?php

namespace App\Domain\Players\Actions;

use App\Domain\Players\Models\Player;

class PostPlayerAction
{
    public function execute(array $fields): Player
    {
        return Player::create($fields);
    }
}
