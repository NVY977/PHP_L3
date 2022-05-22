<?php

namespace App\Domain\Teams\Actions;

use App\Domain\Teams\Models\Team;

class PutTeamAction
{
    public function execute(int $id, array $fields): Team
    {
        $team = Team::findOrFail($id);
        $team->update($fields);
        return $team;
    }
}
