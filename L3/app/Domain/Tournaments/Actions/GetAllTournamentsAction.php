<?php

namespace App\Domain\Tournaments\Actions;

use App\Domain\Tournaments\Models\Tournament;

class GetAllTournamentsAction
{
    public function execute(): array
    {
        return Tournament::all()->toArray();
    }
}
