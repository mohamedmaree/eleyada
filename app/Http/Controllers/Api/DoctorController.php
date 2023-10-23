<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Services\Image;
use App\Services\UserRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Api\DoctorsResource;
use App\Http\Resources\Api\DoctorsCollection;
use App\Traits\ResponseTrait;

class DoctorController extends Controller
{
    use ResponseTrait;

    public function show(){
        $doctorData = auth()->user()->load([
            'country',
            'speciality',
            'academicDegree',
            'certificates:image,doctor_id',
            'clinics.Pictures:image,clinic_id',
            'clinics.Numbers:clinic_id,number'
        ]);

        return response()->json(['result' => $doctorData], 200);
    }

    public function index(){
        $name = request()->query('name');
        $doctors  = Doctor::when($name , function ($q)use($name){
                                return $q->whereFuzzy('name', $name);
                            })
                            ->orderBy('name','ASC')
                            ->paginate($this->paginateNum());
        return $this->successData(new DoctorsCollection($doctors));
    }

    public function showDoctor(Doctor $doctor){
        $doctorData = $doctor->load(
            [
                'speciality',
                'certificates',
                'clinics',
                'clinics.Pictures',
                'clinics.Numbers'
            ]
        );
        return $this->successData(new DoctorsResource($doctorData));

    }

    public function update(UpdateDoctorRequest $request){
        try {
            DB::beginTransaction();

            // updated user related data
            $user = auth()->user();
            $imagePath = $user->image;
            $user->update([
                'name' => $request['name'] ?? $user->name,
                'email' => $request['email'] ?? $user->email,
                'country_id' => $request['country_id'] ?? $user->country_id,
                'phone_number' => $request['phone_number'] ?? $user->phone_number,
                'image' => $request->hasFile('image') ? (new Image($request->file('image'), 'doctors'))->save() : $user->image,
            ]);

            /**
             * @var Doctor $doctor
             */
            $doctor = $user->doctor;
            $identityPath = $doctor->identity_proof;

            $doctor->update([
                'academic_degree_id' => $request['academic_degree_id'] ?? $doctor->academic_degree_id,
                'speciality_id' => $request['speciality_id'] ?? $doctor->speciality_id,
                'identity_proof' => $request->hasFile('identity_proof')
                    ? (new Image($request->file('identity_proof'), 'doctor_identity'))->save()
                    : $doctor->identity_proof,
            ]);

            DB::commit();

            if ($request->hasFile('image')) {
                Image::delete($imagePath);
            }

            if ($request->hasFile('identity_proof')) {
                Image::delete($identityPath);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['result' => 'Doctor data was updated successfully'], 200);
    }

    public function destroy(): JsonResponse
    {
        auth()->user()->delete();

        return response()->json(['result' => 'Doctor data was deleted successfully'], 200);
    }

}
