<?php

namespace App\Http\ApiV1\Modules\Tournaments\Controllers;

use App\Domain\Players\Actions\DeletePlayerAction;
use App\Domain\Players\Actions\GetAllPlayersAction;
use App\Domain\Players\Actions\GetPlayerAction;
use App\Domain\Players\Actions\PatchPlayerAction;
use App\Domain\Players\Actions\PostPlayerAction;
use App\Domain\Players\Actions\PutPlayerAction;
use App\Domain\Tournaments\Actions\DeleteTournamentAction;
use App\Domain\Tournaments\Actions\GetAllTournamentsAction;
use App\Domain\Tournaments\Actions\GetTournamentAction;
use App\Domain\Tournaments\Actions\PatchTournamentAction;
use App\Domain\Tournaments\Actions\PostTournamentAction;
use App\Domain\Tournaments\Actions\PutTournamentAction;
use App\Http\ApiV1\Modules\Players\Requests\PatchPlayerRequest;
use App\Http\ApiV1\Modules\Players\Requests\PostPlayerRequest;
use App\Http\ApiV1\Modules\Players\Requests\PutPlayerRequest;
use App\Http\ApiV1\Modules\Players\Resources\PlayerResource;
use App\Http\ApiV1\Modules\Tournaments\Requests\PatchTournamentRequest;
use App\Http\ApiV1\Modules\Tournaments\Requests\PostTournamentRequest;
use App\Http\ApiV1\Modules\Tournaments\Requests\PutTournamentRequest;
use App\Http\ApiV1\Modules\Tournaments\Resources\TournamentResource;
use Illuminate\Http\JsonResponse;

class TournamentController
{
    public function getList(GetAllTournamentsAction $action)
    {
        $tournaments = $action->execute();
        return response()->json(["data" => $tournaments]);
    }

    public function get(GetTournamentAction $action, int $id)
    {
        return new TournamentResource($action->execute($id));
    }

    public function post(PostTournamentAction $action, PostTournamentRequest $request)
    {
        return new TournamentResource($action->execute($request->validated()));
    }

    public function delete(DeleteTournamentAction $action, int $id): JsonResponse
    {
        $action->execute($id);
        return response()->json(["data" => null]);
    }

    public function patch(PatchTournamentAction $action, PatchTournamentRequest $request, int $id)
    {
        return new TournamentResource($action->execute($id, $request->validated()));
    }

    public function put(PutTournamentAction $action, PutTournamentRequest $request, int $id)
    {
        return new TournamentResource($action->execute($id, $request->validated()));
    }
}
