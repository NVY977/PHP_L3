<?php

namespace App\Domain\Tournaments\Actions;

use App\Domain\Tournaments\Models\Tournament;

class GetTournamentAction
{
    public function execute(int $id): Tournament
    {
        return Tournament::findOrFail($id);
    }
}
