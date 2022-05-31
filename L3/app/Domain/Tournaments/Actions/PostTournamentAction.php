<?php

namespace App\Domain\Tournaments\Actions;

use App\Domain\Tournaments\Models\Tournament;

class PostTournamentAction
{
    public function execute(array $fields): Tournament
    {
        return Tournament::create($fields);
    }
}
