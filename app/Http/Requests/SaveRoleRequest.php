<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveRoleRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'min:3',
                'max:60',
                Rule::unique('roles')->ignore($this->role),
            ],
            'display_name' => [
                'required',
                'min:3',
                'max:60',
                Rule::unique('roles')->ignore($this->role),
            ],
            'description' => [
                'sometimes',
                'nullable',
                'max:255',
                'min:3'
            ],
        ];
    }

    /* ESTA ES OTRA FORMA DE VALIDAR LO MISMO, PREGUNTANDO POR EL METODO DE LA RUTA Y AGREGANDO O QUITANDO REGLAS */

    // public function rules()
    // {
    //     $rules = [
    //         'display_name' => [
    //             'required',
    //             'min:3',
    //             'max:60',
    //             Rule::unique('roles')->ignore($this->role),
    //         ],
    //         'description' => [
    //             'sometimes',
    //             'nullable',
    //             'max:255',
    //             'min:3'
    //         ],
    //     ];

    //     if ($this->method() !== 'PATCH') {
    //         $rules['name'] = [
    //             'required',
    //             'min:3',
    //             'max:60',
    //             Rule::unique('roles')->ignore($this->role),
    //         ];
    //     }

    //     return $rules;
    // }

    public function messages()
    {
        return [
            'name.required' => 'El identificador del permiso es obligatorio',
            'name.min' => 'El identificador del permiso debe tener como mínimo 3 caracteres',
            'name.max' => 'El identificador del permiso debe tener como máximo 60 caracteres',
            'name.unique' => 'El identificador ya se encuentra utilizado',
            'display_name.required' => 'El nombre del permiso es obligatorio',
            'display_name.min' => 'El nombre del permiso debe tener como mínimo 3 caracteres',
            'display_name.max' => 'El nombre del permiso debe tener como máximo 60 caracteres',
            'display_name.unique' => 'El nombre ya se encuentra utilizado',
            'description.min' => 'La descripción del permiso debe tener como mínimo 3 caracteres',
            'description.max' => 'La descripción del permiso debe tener como máximo 255 caracteres',
        ];
    }
}
