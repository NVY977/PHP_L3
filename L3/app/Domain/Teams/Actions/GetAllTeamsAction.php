<?php

namespace App\Domain\Teams\Actions;

use App\Domain\Teams\Models\Team;

class GetAllTeamsAction
{
    public function execute(): array
    {
        return Team::all()->toArray();
    }
}
