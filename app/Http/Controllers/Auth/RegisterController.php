<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterDoctorRequest;
use App\Http\Requests\Api\RegisterPatientRequest;
use App\Models\User;
use App\Services\Image;
use App\Services\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    private function createUser(string $name, string $email, string $password, $country_id, $phone_number, $file): User
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'country_id' => $country_id,
            'phone_number' => $phone_number,
            'image' => $file ?
                (new Image($file, 'users'))->save()
                : null,
            'verification_code' => mt_rand(100000, 999999)
        ]);

        return $user;
    }

    public function registerAsDoctor(RegisterDoctorRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $this->createUser(
                $request['name'],
                $request['email'],
                $request['password'],
                $request['country_id'],
                $request['phone_number'],
                $request->file('image')
            );
            $user->doctor()->create([
                'academic_degree' => $request['academic_degree'],
                'speciality_id' => $request['speciality_id'],
                'identity_proof' => $request->file('identity_proof') ?
                    (new Image($request->file('identity_proof'), 'doctor_identity'))->save()
                    : null,
            ]);

            $token = $user->createToken('authToken')->plainTextToken;
            DB::commit();

            event(new Registered($user));
            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function registerAsPatient(RegisterPatientRequest $request): JsonResponse
    {

        try {
            DB::beginTransaction();
            $user = $this->createUser(
                $request['name'],
                $request['email'],
                $request['password'],
                $request['country_id'],
                $request['phone_number'],
                $request->file('image')
            );

            $user->patient()->create();

            $token = $user->createToken('authToken')->plainTextToken;
            DB::commit();

            event(new Registered($user));
            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }


}
