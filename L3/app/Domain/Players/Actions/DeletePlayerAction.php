<?php

namespace App\Domain\Players\Actions;

use App\Domain\Players\Models\Player;

class DeletePlayerAction
{
    public function execute(int $id): void
    {
        Player::findOrFail($id)->delete();
    }
}
