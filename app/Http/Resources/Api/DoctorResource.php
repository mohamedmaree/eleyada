<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Settings\CountryResource;
use App\Http\Resources\Api\Settings\SpecialityResource;
use App\Http\Resources\Api\Settings\AcademicDegreeResource;
use App\Http\Resources\Api\CertificateResource;
use App\Http\Resources\Api\ClinicResource;

class DoctorResource extends JsonResource
{
    private $token               = '';

    public function setToken($value) {
      $this->token = $value;
      return $this;
    }
  
    public function toArray($request) {
      return [
        'id'                  => $this->id,
        'type'                => 'doctor',
        'name'                => $this->name,
        'email'               => $this->email,
        'country_code'        => $this->country_code,
        'phone'               => '0'.$this->phone,
        'full_phone'          => $this->full_phone,
        'image'               => $this->image,
        'lang'                => $this->lang,
        'is_notify'           => $this->is_notify,
        'country'             => new CountryResource($this->country),
        'speciality'          => new SpecialityResource($this->speciality),
        'academic_degree'     => new AcademicDegreeResource($this->academicDegree),
        'certificates'        => CertificateResource::collection($this->certificates),
        'clinics'             => ClinicResource::collection($this->clinics),
        'identity_proof'      => $this->identity_proof,
        'token'               => $this->token,
      ];
    }
}
