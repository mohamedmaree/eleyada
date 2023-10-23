<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Settings\CategoryResource;
use App\Http\Resources\Api\Settings\CountryResource;

class UsersResource extends JsonResource {


  public function toArray($request) {
    return [
      'id'                  => $this->id,
      'type'                => 'patient',
      'name'                => $this->name,
      'email'               => $this->email,
      'country_code'        => $this->country_code,
      'phone'               => '0'.$this->phone,
      'full_phone'          => $this->full_phone,
      'image'               => $this->image,
      'is_answered_questions' =>$this->isAnsweredQuestions(),
      'lang'                => $this->lang,
      'is_notify'           => $this->is_notify,
      'goal'                => new CategoryResource($this->category),
      'country'             => new CountryResource($this->country),
      'start_pregnant_date' => $this->start_pregnant_date,
      'period_date'         => $this->period_date,
      'intercourse_date'    => $this->intercourse_date,

      'period_cycle_length' => $this->period_cycle_length,
      'period_length'       => $this->period_length,
     
      'pill_notifications'  => $this->pill_notifications,
      'pill_taken_date'     => $this->pill_taken_date,
      'pill_type'           => $this->pill_type,
      
      'iud_inspection_notifications' => $this->iud_inspection_notifications,
      'iud_installed_date'           => $this->iud_installed_date,
      'iud_type'                     => $this->iud_type,
      
      'injection_notifications'      => $this->injection_notifications,
      'last_visit_doctor_date'       => $this->last_visit_doctor_date,
      
      'care_giver_name'           => $this->care_giver_name,
      'care_giver_email'          => $this->care_giver_email,
      'care_giver_link'           => $this->care_giver_link,
    ];
  }
}
