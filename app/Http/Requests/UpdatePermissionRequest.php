<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'display_name' => 'required|min:3|max:60',
            'description' => 'sometimes|nullable|min:3|max:500'
        ];
    }

    public function messages()
    {
        return [
            'display_name.required' => 'El nombre del permiso es obligatorio',
            'display_name.min' => 'El nombre del permiso debe tener como mínimo 3 caracteres',
            'display_name.max' => 'El nombre del permiso debe tener como máximo 255 caracteres',
            'description.min' => 'La descripción del permiso debe tener como mínimo 3 caracteres',
            'description.max' => 'La descripción del permiso debe tener como máximo 255 caracteres',
        ];
    }
}
