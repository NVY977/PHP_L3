<?php

namespace App\Domain\Tournaments\Actions;

use App\Domain\Tournaments\Models\Tournament;

class PutTournamentAction
{
    public function execute(int $id, array $fields): Tournament
    {
        $tournament = Tournament::findOrFail($id);
        $tournament->update($fields);
        return $tournament;
    }
}
