<?php

namespace App\Http\Requests\Admin\orders;

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
            'doctor_id'             => 'required|exists:doctors,id',
            'region_id'             => 'nullable|exists:regions,id',
            'name'                  => 'required|max:191',
            'phone_number'          => 'required',
            'address'                => 'nullable',
            'delivery'               => 'nullable',
            'total_amount'           => 'nullable',
            'status'                 => 'required',
            'delivery_confirmation'  => 'nullable',
        ];
    }
}
