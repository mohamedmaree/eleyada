<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function update(ChangePasswordRequest $request)
    {
        auth()->user()->update([
            'password' => Hash::make($request['password'])
        ]);

        return response()->json(['result' => 'Password was changed successfully'], 200);
    }
}
