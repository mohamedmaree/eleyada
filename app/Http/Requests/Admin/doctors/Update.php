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
            'name'         => 'required|max:191',
            'country_code' => 'required',
            'phone'    => 'required|min:8||unique:users,phone,'.$this->id.',id,deleted_at,NULL',
            'email'    => 'required|email|max:191|unique:users,email,'.$this->id.',id,deleted_at,NULL',
            'password' => ['nullable', 'min:6'],

            'country_id'          => 'nullable|exists:countries,id',
            'speciality_id'       => 'required|exists:specialities,id',
            'academic_degree_id'  => 'nullable|exists:academic_degrees,id',
            
            'is_blocked'  => 'nullable',
            'active'      => 'nullable',
            
            'identity_proof'  => 'nullable|image',
            'image'           => 'nullable|image',
        ];
    }
}
