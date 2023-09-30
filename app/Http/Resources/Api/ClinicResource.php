<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\PicturesResource;
use App\Http\Resources\Api\NumbersResource;
use App\Http\Resources\Api\DoctorResource;

class ClinicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'doctor_id'     => $this->doctor_id,
            'booking_link'  => $this->booking_link,
            'location_link' => $this->location_link,
            'address'       => $this->address,
            'pictures'     => PicturesResource::collection($this->Pictures),
            'numbers'      => NumbersResource::collection($this->Numbers),
            // 'doctor'       => new DoctorResource($this->doctor),
    ];
    }
}
