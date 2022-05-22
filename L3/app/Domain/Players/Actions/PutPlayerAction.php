<?php

namespace App\Domain\Players\Actions;

use App\Domain\Players\Models\Player;

class PutPlayerAction
{
    public function execute(int $id, array $fields): Player
    {
        $player = Player::findOrFail($id);
        $player->update($fields);
        return $player;
    }
}
