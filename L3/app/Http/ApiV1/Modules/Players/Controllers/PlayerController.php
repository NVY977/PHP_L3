<?php

namespace App\Http\ApiV1\Modules\Players\Controllers;

use App\Domain\Players\Actions\DeletePlayerAction;
use App\Domain\Players\Actions\GetAllPlayersAction;
use App\Domain\Players\Actions\GetPlayerAction;
use App\Domain\Players\Actions\PatchPlayerAction;
use App\Domain\Players\Actions\PostPlayerAction;
use App\Domain\Players\Actions\PutPlayerAction;
use App\Http\ApiV1\Modules\Players\Requests\PatchPlayerRequest;
use App\Http\ApiV1\Modules\Players\Requests\PostPlayerRequest;
use App\Http\ApiV1\Modules\Players\Requests\PutPlayerRequest;
use App\Http\ApiV1\Modules\Players\Resources\PlayerResource;
use Illuminate\Http\JsonResponse;


class PlayerController
{
    public function getList(GetAllPlayersAction $action)
    {
        $players = $action->execute();
        return response()->json($players);
    }

    public function get(GetPlayerAction $action, int $id)
    {
        return new PlayerResource($action->execute($id));
    }

    public function post(PostPlayerAction $action, PostPlayerRequest $request)
    {
        return new PlayerResource($action->execute($request->validated()));
    }

    public function delete(DeletePlayerAction $action, int $id): JsonResponse
    {
        $action->execute($id);
        return response()->json(["data" => null]);
    }

    public function patch(PatchPlayerAction $action, PatchPlayerRequest $request, int $id)
    {
        return new PlayerResource($action->execute($id, $request->validated()));
    }

    public function put(PutPlayerAction $action, PutPlayerRequest $request, int $id)
    {
        return new PlayerResource($action->execute($id, $request->validated()));
    }
}
