<?php

namespace App\Http\ApiV1\Modules\Players\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PatchPlayerRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'age' => 'required|integer',
            'city' => 'required|string|max:75',
        ];
    }
}
