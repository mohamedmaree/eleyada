<?php

namespace App\Http\Requests\Admin\avatarimages;

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
            'image'                => 'required|image',
        ];
    }
}
