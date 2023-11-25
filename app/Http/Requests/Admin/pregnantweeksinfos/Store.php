<?php

namespace App\Http\Requests\Admin\pregnantweeksinfos;

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
            'order'                 => 'required|numeric',
            'name.*'                => 'required|max:191',
            'mother_info.*'         => 'required',
            'baby_info.*'           => 'required',
            'baby_weight'           => 'required',
            'baby_height'           => 'required',
            'image'                 => 'required|image',
        ];
    }
}
