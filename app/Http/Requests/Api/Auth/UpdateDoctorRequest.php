<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends BaseApiRequest
{
    public function __construct(Request $request) {
        if($request['phone']){
          $request['phone']        = fixPhone($request['phone']);
        }
        if($request['country_code']){
          $request['country_code'] = fixPhone($request['country_code']);
        }
    
      //   if ($request['phone'] && auth()->user()->phone !== $request['phone']) {
      //     $request['active'] = false;
      //   }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable',
            'email' => 'nullable|email|max:50,unique:doctors,email,'.$this->id,
            'country_id' => ['nullable', 'exists:countries,id'],
            'phone' => 'nullable|numeric|digits_between:9,10|unique:users,email,'.$this->id,
            'image' => ['nullable', 'image', 'file', 'max:2048'],

            'academic_degree_id' => 'nullable|exists:academic_degrees,id',
            'identity_proof' => ['nullable', 'image', 'file', 'max:2048'],
            'speciality_id' => 'nullable|exists:specialities,id',
        ];
    }
}
