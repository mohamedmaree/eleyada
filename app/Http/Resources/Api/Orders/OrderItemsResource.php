<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Products\ProductsResource;

class OrderItemsResource extends JsonResource
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
            'order_id'    => $this->order_id,
            'quantity'    => $this->quantity,
            'price'    => $this->price,
            'subtotal'    => $this->subtotal,
            'product'      => new ProductsResource($this->product),
        ];
    }
}
