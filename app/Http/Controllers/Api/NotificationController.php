<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function markAsRead($id): JsonResponse
    {
        DatabaseNotification::find($id)->markAsRead();

        return response()->json(['result'=>'success'], 200);
    }
}
