<?php

namespace App\Http\Requests\Admin\symptoms;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'                  => 'required|max:191',
            'parent_id'                => 'nullable|exists:symptoms,id',
        ];
    }
}
