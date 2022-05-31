<?php

namespace App\Domain\Teams\Actions;

use App\Domain\Teams\Models\Team;

class PostTeamAction
{
    public function execute(array $fields): Team
    {
        return Team::create($fields);
    }
}
