<?php

namespace App\Http\ApiV1\Modules\Players\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class PlayerResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'team_id' => $this->team_id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
