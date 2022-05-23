<?php

namespace App\Http\ApiV1\Modules\Teams\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class TeamResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tournament_id' => $this->tournament_id,
            'title' => $this->title,
            'color' => $this->color,
            'city' => $this->city,
        ];
    }
}
