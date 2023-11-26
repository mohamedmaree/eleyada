<?php

namespace App\Http\Requests\Admin\orders;

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
            'doctor_id'             => 'required|exists:doctors,id',
            'region_id'             => 'nullable|exists:regions,id',
            'name'                  => 'required|max:191',
            'phone_number'          => 'required',
            'address'                => 'nullable',
            'delivery'               => 'required',
            'total_amount'           => 'required',
            'status'                 => 'required',
            'delivery_confirmation'  => 'nullable',
        ];
    }
}
