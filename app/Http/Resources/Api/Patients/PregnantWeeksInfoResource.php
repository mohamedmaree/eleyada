<?php

namespace App\Http\Resources\Api\Patients;

use Illuminate\Http\Resources\Json\JsonResource;

class PregnantWeeksInfoResource extends JsonResource
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
            'order'       => $this->order,
            'name'        => $this->name,
            'mother_info' => $this->mother_info,
            'baby_info'   => $this->baby_info,
            'baby_weight' => $this->baby_weight,
            'baby_height' => $this->baby_height,
            'image'       => $this->image,
        ];
    }
}
