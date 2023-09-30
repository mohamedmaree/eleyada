<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\JsonResponse;

class GovernorateController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['result' => Governorate::translatedBulk()], 200);
    }
}
