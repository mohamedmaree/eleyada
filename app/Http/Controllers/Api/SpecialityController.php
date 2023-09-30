<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\Settings\SpecialityResource;

class SpecialityController extends Controller
{
    use ResponseTrait;
    
    public function show(){
        $speciality = auth()->user()->speciality;
        return $this->successData(new SpecialityResource($speciality));
    }

}
