<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveTagRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => [
                "required",
                "min:3",
                Rule::unique('tags', 'name')->ignore($this->tag),
            ],
        ];
    }
}
