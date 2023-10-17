<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class UpdateProfileRequest extends BaseApiRequest {
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

  public function rules() {
    return [
      'name' => 'nullable',
      'email' => 'nullable|email|max:50,unique:users,email,'.$this->id,
      'country_id' => ['nullable', 'exists:countries,id'],
      'phone' => 'nullable|numeric|digits_between:9,10|unique:users,email,'.$this->id,
      'image' => ['nullable', 'image', 'file', 'max:2048'],
  ];
  }

  public function withValidator($validator) {
    $validator->after(function ($validator) {
      // if ($this->has('old_password') && !Hash::check($this->old_password, auth()->user()->password)) {
      //   $validator->errors()->add('old_password', trans('auth.incorrect_old_pass'));
      // }
    });
  }

}
