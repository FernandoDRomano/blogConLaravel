<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body' => 'required|string',
            'user_id' => 'exists:users,id',
            'post_id' => 'exists:posts,id',
            'parent_comment_id' => 'nullable|exists:comments,id'
        ];
    }

    public function messages()
    {
        return[
            'body.required' => 'El comentario es requerido.',
            'body.string' => 'El comentario tiene caracteres no permitidos'
        ];
    }
}
