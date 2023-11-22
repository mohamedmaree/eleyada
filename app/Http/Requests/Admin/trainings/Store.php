<?php

namespace App\Http\Requests\Admin\trainings;

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
            'title.*'          => 'required|max:191',
            'description.*'    => 'nullable',
            'topics.*'         => 'nullable',
            'link_to_order'    => 'nullable',
            'video'            => 'nullable',
            'is_paid'          => 'required',
            'product_id'       => 'nullable|exists:products,id',
            'image'            => 'nullable|image',
        ];
    }
}
