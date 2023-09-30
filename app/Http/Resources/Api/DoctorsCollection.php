<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\DoctorsResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorsCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => DoctorsResource::collection($this->collection),
        ];

    }
}
