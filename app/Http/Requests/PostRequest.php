<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

            'title' => 'required|string|min:6',
            'backdate' => 'present|nullable|date',
            'image' => 'mimetypes:image/jpeg,image/png|max:5120',
            'category' => 'string|alpha_num|min:3',
            'description' => 'string|min:10',
            'tags' => 'string|max:256'

        ];
    }
}
