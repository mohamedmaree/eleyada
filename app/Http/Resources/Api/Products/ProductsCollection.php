<?php

namespace App\Http\Resources\Api\Products;

use App\Http\Resources\Api\Products\ProductsResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => ProductsResource::collection($this->collection),
        ];

    }
}
