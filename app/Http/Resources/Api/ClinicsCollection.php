<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\ClinicsResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClinicsCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => ClinicsResource::collection($this->collection),
        ];

    }
}
