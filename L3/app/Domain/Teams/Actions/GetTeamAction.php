<?php

namespace App\Domain\Teams\Actions;

use App\Domain\Teams\Models\Team;

class GetTeamAction
{
    public function execute(int $id): Team
    {
        return Team::findOrFail($id);
    }
}
