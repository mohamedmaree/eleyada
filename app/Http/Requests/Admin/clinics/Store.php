<?php

namespace App\Http\Requests\Admin\clinics;

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
            'name'                  => 'required|max:191',
            'doctor_id'             => 'required|exists:doctors,id',
            'booking_link'          => 'nullable',
            'location_link'         => 'nullable',
            'address'               => 'nullable',
            'lat'                   => 'nullable',
            'lng'                   => 'nullable',
        ];
    }
}
