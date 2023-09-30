<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Api\TraningResource;
use App\Traits\ResponseTrait;

class TrainingController extends Controller
{
    use ResponseTrait;
    public function show(Training $training)
    {
        return $this->successData(new TraningResource($training->load(['product','product.pictures'])));
    }
}
