<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class UpdateCareGiverDataRequest extends BaseApiRequest {

  public function rules() {
    return [
      'care_giver_name'    => 'nullable',
      'care_giver_email'   => 'nullable|email',
    ];
  }

}
