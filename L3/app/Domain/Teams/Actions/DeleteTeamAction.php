<?php

namespace App\Domain\Teams\Actions;

use App\Domain\Teams\Models\Team;

class DeleteTeamAction
{
    public function execute(int $id): void
    {
        Team::findOrFail($id)->delete();
    }
}
