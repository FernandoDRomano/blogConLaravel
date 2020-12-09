<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'title' => [
                'required',
                'max:255',
                'min:3',
                Rule::unique('posts')->ignore($this->post)
            ],
            'extract' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            'published_at' => 'sometimes|nullable|date',
            'iframe' => 'sometimes'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'El campo Categoría es requerido',
            'tags.required' => 'El campo Etiqueta es requerido',
            'published_at.date' => 'No es una fecha valida',
            'published_at.after_or_equal' => 'La fecha debe ser igual o superior a la actual'
        ];
    }
}
