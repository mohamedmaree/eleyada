<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Discussion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\DiscussionResource;

class DiscussionController extends Controller
{
    use ResponseTrait;
    public function show(Discussion $discussion)
    {
        return $this->successData(new DiscussionResource($discussion));
    }
}
