<?php

namespace App\Http\Requests\Admin\products;

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
            'name.*'                  => 'required',
            'details.*'               => 'nullable',
            'benefits.*'              => 'nullable',
            'product_type_id'         => 'required|exists:product_types,id',
            'price'                   => 'required',
            'video'                   => 'nullable',
            'icon'                    => 'nullable|image',
        ];
    }
}
