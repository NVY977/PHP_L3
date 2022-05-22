<?php

namespace App\Http\ApiV1\Modules\Tournaments\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PostTournamentRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'prize' => 'required|integer|min:100000|max:1000000',
            'city' => 'required|string|max:75',
        ];
    }
}
