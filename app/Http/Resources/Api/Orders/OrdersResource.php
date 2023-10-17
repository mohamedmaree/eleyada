<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Orders\OrderItemsResource;

class OrdersResource extends JsonResource
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
            'order_num' => $this->order_num,
            'doctor_id' => $this->doctor_id,
            'region_id' => $this->region_id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'delivery' => $this->delivery,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'created_at' => date('Y-m-d H:i',strtotime($this->created_at)),
            'order_items' => OrderItemsResource::collection($this->orderItems),

        ];
    }
}
