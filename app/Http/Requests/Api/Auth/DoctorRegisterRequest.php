<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class DoctorRegisterRequest extends BaseApiRequest {
  
  public function __construct(Request $request) {
    $request['phone']        = fixPhone($request['phone']);
    // $request['country_code'] = fixPhone($request['country_code']);
  }

  public function rules() {
    return [
      'name'         => 'required|max:50',
      // 'country_code' => 'nullable|numeric|digits_between:2,5',
      'phone'        => 'nullable|numeric|digits_between:9,10|unique:doctors,phone,NULL,id,deleted_at,NULL',
      'email'        => 'required|email|unique:doctors,email,NULL,id,deleted_at,NULL|max:50',
      'password'     => 'required|min:6|max:100',
      'image' => ['nullable', 'image', 'file', 'max:5120'],
     
      'country_id' => ['nullable', 'exists:countries,id'],
      'academic_degree_id' => 'nullable|exists:academic_degrees,id',//optional
      'identity_proof' => ['nullable', 'image', 'file', 'max:5120'],
      'speciality_id' => 'nullable|exists:specialities,id',//optional
    ];
  }

}
