<?php

namespace App\Http\Requests\Admin\doctors;

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
            'name'                  => 'required|max:191',
            'phone'                 => 'required|numeric|unique:doctors,phone,'.$this->id,
            'email'                 => 'required|email|max:191|unique:doctors,email,'.$this->id,
            'password'              => ['nullable','max:191'],
            'avatar'                => ['nullable','image'],
        ];
    }
}
