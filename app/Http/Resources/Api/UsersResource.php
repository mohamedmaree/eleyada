<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource {


  public function toArray($request) {
    return [
      'id'                  => $this->id,
      'name'                => $this->name,
      'email'               => $this->email,
      'country_code'        => $this->country_code,
      'phone'               => $this->phone,
      'full_phone'          => $this->full_phone,
      'image'               => $this->image,
      'lang'                => $this->lang,
      'is_notify'           => $this->is_notify,
    ];
  }
}
