<?php

namespace App\Http\Requests\Admin\countries;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'                => 'required|max:191',
            'key'                    => 'required|unique:countries,key',
            'flag'                   => 'nullable',
        ];
       
    }
}
