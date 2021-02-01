<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveUserRequest extends FormRequest
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
        // return [
        //     'name' => 'required|min:3|max:150',
        //     'last_name' => 'required|min:3|max:100',
        //     'photo' => [
        //         'sometimes',
        //         'nullable',
        //         'image',
        //         'max:2048',
        //         Rule::dimensions()->maxWidth(2000)->maxHeight(2000)->ratio(1 / 1),
        //     ],
        //     'email' => [
        //         'required',
        //         'email',
        //         Rule::unique('users')->ignore($this->user),
        //     ],
        //     'roles' => [
        //         Rule::exists('roles', 'name')
        //     ],
        //     'permissions' => [
        //         Rule::exists('permissions', 'name')
        //     ]
        // ];

        $rules = [
            'name' => 'required|min:3|max:150',
            'last_name' => 'required|min:3|max:100',
            'photo' => [
                'sometimes',
                'nullable',
                // 'image', DEJO DE FUNCIONAR ESTA REGLA CON TODAS LAS EXTENCIONES DE LAS IMAGENES
                'mimes:jpeg,jpg,png,bmp',
                'max:2048',
                Rule::dimensions()->maxWidth(2000)->maxHeight(2000),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],
            'roles' => [
                Rule::exists('roles', 'name')
            ],
            'permissions' => [
                Rule::exists('permissions', 'name')
            ]
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['confirmed', 'min:6', 'max:16'];
        }

        return $rules;
    }
}
