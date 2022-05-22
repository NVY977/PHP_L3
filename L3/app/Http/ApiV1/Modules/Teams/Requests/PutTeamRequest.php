<?php

namespace App\Http\ApiV1\Modules\Teams\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PutTeamRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'tournament_id' => 'required|integer',
            'title' => 'required|string|max:100',
            'color' => 'required|string|max:50',
            'city' => 'required|string|max:75',
        ];
    }
}
