<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Settings\CountryResource;
use App\Traits\ResponseTrait;

class CountryController extends Controller
{
  use ResponseTrait;
  public function show()
    {
        $country = auth()->user()->country;
        return $this->successData(new CountryResource($country));
    }
}
