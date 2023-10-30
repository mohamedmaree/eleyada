<?php

namespace App\Http\Resources\Api\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductOptionsResource extends JsonResource
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
            'option'        => $this->option->name??null,
            'option_values' => ProductOptionValuesResource::collection($this->productOptionValues),
        ];
    }
}
