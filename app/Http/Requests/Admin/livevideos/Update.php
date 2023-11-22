<?php

namespace App\Http\Requests\Admin\livevideos;

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
            'title.*'          => 'required|max:191',
            'topics.*'         => 'nullable',
            'status'           => 'required',
            'speaker_name'     => 'required',
            'link'             => 'required',
            'image'            => 'nullable|image',
        ];
    }
}
