<?php

namespace App\Http\Resources\Api\Patients;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Patients\AdviceItemsResource;

class AdviceResource extends JsonResource
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
            'name'        => $this->name,
            'content'     => $this->content,
            'image'       => $this->image,
            'video'       => $this->video,
            'product_id'  => $this->product_id,
            'type'        => $this->type,
        ];
    }
}
