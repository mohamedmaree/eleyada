<?php

namespace App\Http\Resources\Api\Orders;

use App\Http\Resources\Api\Orders\OrdersResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrdersCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => OrdersResource::collection($this->collection),
        ];

    }
}
