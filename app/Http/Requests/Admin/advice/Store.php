<?php

namespace App\Http\Requests\Admin\advice;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'           => 'required|max:191',
            'content.*'        => 'nullable',
            'image'            => 'nullable|image',
            'video'            => 'nullable',
            'product_link'     => 'nullable',
            'type'             => 'required',
        ];
    }
}
