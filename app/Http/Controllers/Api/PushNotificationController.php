<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{

    public function updateDeviceToken(Request $request)
    {
        auth()->user()->device_token = $request->deviceToken;
        auth()->user()->save();

        return response()->json(['result' => 'Token were saved successfully'], 200);
    }

    public static function sendPushNotification($token, $message, $status): JsonResponse
    {
        $fields = [
            'to' => $token,
            'data' => [
                'body' => $message,
                'title' => config('app.name'),
                'sound' => 'default',
                'action' => $status,
            ],
        ];

        $result = static::send($fields);

        return $result;
    }

    public static function send(array $fields): JsonResponse
    {
        $headers = [
            'Authorization' => ' key=' . config('services.firebase.server_key'),
            'Content-Type' => 'application/json'
        ];
        $url = 'https://fcm.googleapis.com/fcm/send';


        $client = new \GuzzleHttp\Client();
        $response = $client->request(
            "POST",
            $url,
            [
                "headers" => $headers,
                "json" => $fields
            ]
        );
        $result = $response->getBody();
        Log::info($result);
        return response()->json(["result" => "success"]);
    }


}
