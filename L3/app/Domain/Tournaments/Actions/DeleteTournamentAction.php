<?php

namespace App\Domain\Tournaments\Actions;

use App\Domain\Tournaments\Models\Tournament;

class DeleteTournamentAction
{
    public function execute(int $id): void
    {
        Tournament::findOrFail($id)->delete();
    }
}
