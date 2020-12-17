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
}
