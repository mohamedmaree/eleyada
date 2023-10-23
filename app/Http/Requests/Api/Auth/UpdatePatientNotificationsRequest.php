<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class UpdatePatientNotificationsRequest extends BaseApiRequest {

  public function rules() {
    return [
      'iud_inspection_notifications' => 'nullable',
      'iud_installed_date'           => 'nullable',
      'iud_type'                     => 'nullable',
      
      'pill_notifications' => 'nullable',
      'period_date'        => 'nullable',
      'pill_taken_date'    => 'nullable',
      'pill_type'          => 'nullable',
     
      'injection_notifications'  => 'nullable',
      'last_visit_doctor_date'   => 'nullable',

    ];
  }

}
