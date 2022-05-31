<?php

namespace App\Http\ApiV1\Modules\Tournaments\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class TournamentResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'prize' => $this->prize,
            'city' => $this->city,
        ];
    }
}
