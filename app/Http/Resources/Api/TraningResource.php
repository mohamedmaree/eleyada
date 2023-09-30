<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Products\ProductsResource;

class TraningResource extends JsonResource
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
            'id'           => $this->id,
            'title'    => $this->title,
            'description'    => $this->description,
            'topics'    => $this->topics,
            'is_paid'    => $this->is_paid,
            'link_to_order'    => $this->link_to_order,
            'video'    => $this->video,
            'image'    => $this->image,
            'product'      => new ProductsResource($this->product),
        ];
    }
}
