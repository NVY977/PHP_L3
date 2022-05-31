<?php

namespace App\Http\ApiV1\Modules\Teams\Controllers;

use App\Domain\Players\Actions\DeletePlayerAction;
use App\Domain\Teams\Actions\DeleteTeamAction;
use App\Domain\Teams\Actions\GetAllTeamsAction;
use App\Domain\Teams\Actions\GetTeamAction;
use App\Domain\Teams\Actions\PatchTeamAction;
use App\Domain\Teams\Actions\PostTeamAction;
use App\Domain\Teams\Actions\PutTeamAction;
use App\Http\ApiV1\Modules\Teams\Requests\PatchTeamRequest;
use App\Http\ApiV1\Modules\Teams\Requests\PostTeamRequest;
use App\Http\ApiV1\Modules\Teams\Requests\PutTeamRequest;
use App\Http\ApiV1\Modules\Teams\Resources\TeamResource;
use Illuminate\Http\JsonResponse;

class TeamController
{
    public function getList(GetAllTeamsAction $action)
    {
        $teams = $action->execute();
        return response()->json(["data" => $teams]);
    }

    public function get(GetTeamAction $action, int $id)
    {
        return new TeamResource($action->execute($id));
    }

    public function post(PostTeamAction $action, PostTeamRequest $request)
    {
        return new TeamResource($action->execute($request->validated()));
    }

    public function delete(DeleteTeamAction $action, int $id): JsonResponse
    {
        $action->execute($id);
        return response()->json(["data" => null]);
    }

    public function patch(PatchTeamAction $action, PatchTeamRequest $request, int $id)
    {
        return new TeamResource($action->execute($id, $request->validated()));
    }

    public function put(PutTeamAction $action, PutTeamRequest $request, int $id)
    {
        return new TeamResource($action->execute($id, $request->validated()));
    }
}
