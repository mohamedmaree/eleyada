<?php

namespace App\Http\Resources\Api\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPicturesResource extends JsonResource
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
            'id'    => $this->id,
            'image' => $this->image,
            'description' => $this->description
        ];
    }
}
