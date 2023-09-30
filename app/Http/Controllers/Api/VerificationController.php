<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DoctorVerificationRequest;
use App\Http\Requests\Api\VerificationRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller {

    public function verify(DoctorVerificationRequest $request): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(['result' => "User is already verified."], 200);
        }

        if (auth()->user()->code === $request['code']) {
            auth()->user()->markEmailAsVerified();
            return response()->json(['result' => "User was verified successfully"], 200);
        }

        return response()->json(['error' => "Code is incorrect"], 405);
    }

    public function patientVerify(VerificationRequest $request): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(['result' => "User is already verified."], 200);
        }

        if (auth()->user()->code === $request['code']) {
            auth()->user()->markEmailAsVerified();
            return response()->json(['result' => "User was verified successfully"], 200);
        }

        return response()->json(['error' => "Code is incorrect"], 405);
    }

    public function resent(): JsonResponse
    {

        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(['result' => "User is already verified."], 200);
        }

        $user = auth()->user();
        $user->update([
            'verification_code' => mt_rand(100000, 999999)
        ]);

        event(new Registered($user));

        return response()->json(['result' => "Email was sent Successfully"], 405);
    }
}
