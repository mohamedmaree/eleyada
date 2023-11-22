<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class DoctorCheckCodeRequest extends BaseApiRequest {
  // public function __construct(Request $request) {
  //   $request['phone']        = fixPhone($request['phone']);
  //   $request['country_code'] = fixPhone($request['country_code']);
  // }

  public function rules() {
    return [
      'code'         => 'required|max:10',
      'email'       => 'required|email|exists:doctors,email|max:50',
    ];
  }
}
