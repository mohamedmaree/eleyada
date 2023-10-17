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
    ];
  }
}
