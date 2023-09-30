<?php

namespace App\Http\Controllers;

use App\Models\AcademicDegree;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcademicDegreeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['result' => AcademicDegree::translatedBulk()], 200);
    }
}
