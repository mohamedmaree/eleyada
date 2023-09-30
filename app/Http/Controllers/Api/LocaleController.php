<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['result' => [
            [
                'name' => 'Arabic',
                'key' => 'ar'
            ], [
                'name' => 'English',
                'key' => 'en'
            ]
        ]], 200);
    }
}
