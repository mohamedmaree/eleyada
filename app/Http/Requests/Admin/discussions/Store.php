<?php

namespace App\Http\Requests\Admin\discussions;

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
            'topics.*'         => 'nullable',
            'status'           => 'required',
            'speaker_name'     => 'required',
            'discussion_link'  => 'required',
            'image'            => 'nullable|image',
        ];
    }
}
