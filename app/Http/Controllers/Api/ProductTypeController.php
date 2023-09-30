<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['result' => ProductType::translatedBulk()], 200);
    }
}
