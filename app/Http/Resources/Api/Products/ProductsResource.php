<?php

namespace App\Http\Resources\Api\Products;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Settings\ProductTypeResource;
use App\Http\Resources\Api\Products\ProductPicturesResource;

class ProductsResource extends JsonResource
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
            'name' => $this->name,
            'details' => $this->details,
            'benefits' => $this->benefits,
            'price' => $this->price,
            'video' => $this->video,
            'icon' => $this->icon,
            'insertion_technique' => $this->insertion_technique,
            'product_type' => new ProductTypeResource($this->productType),
            'pictures' => ProductPicturesResource::collection($this->pictures),
            'product_custom_field_id' => $this->product_custom_field_id,
            'key' => $this->key,
            // 'value' => $this->value,
            // 'order' => $this->order,
        ];
    }
}
