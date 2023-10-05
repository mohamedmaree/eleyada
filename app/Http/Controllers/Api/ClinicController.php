<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClinicRequest;
use App\Models\Clinic;
use App\Services\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\ClinicResource;

class ClinicController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $clinics = ClinicResource::collection(auth()->user()->clinics);
        return $this->successData($clinics);
    }

    public function show(Clinic $clinic)
    {
        return $this->successData(new ClinicResource($clinic->load('Pictures', 'Numbers')));
    }

    public function store(ClinicRequest $request)
    {
            $clinic = Clinic::create([
                'name' => $request['name'],
                'doctor_id' => auth()->user()->id,
                'location_link' => $request['location_link'],
                'booking_link' => $request['booking_link'],
                'address' => $request['address'],
            ]);
            if($request['phone_numbers']){
                foreach ($request['phone_numbers'] as $number) {
                    $clinic->Numbers()->create([
                        'number' => $number
                    ]);
                }
            }
            if($request->file('images')){
                foreach ($request->file('images') as $image) {
                    $clinic->Pictures()->create([
                        'image' => $image
                    ]);
                }
            }

        return $this->successData(new ClinicResource($clinic));
    }

    public function update(ClinicRequest $request, Clinic $clinic)
    {
            $clinic->update([
                'booking_link' => $request['booking_link'] ?? $clinic->booking_link,
                'name' => $request['name'] ?? $clinic->name,
                'location_link' => $request['location_link'] ?? $clinic->location_link
            ]);


            if (!collect($request['phone_numbers'])->isEmpty()) {
                $clinic->Numbers()->delete();
                foreach ($request['phone_numbers'] as $number) {
                    $clinic->Numbers()->create([
                        'number' => $number
                    ]);
                }
            }

            if (!collect($request['images'])->isEmpty()) {
                $clinic->Pictures->each(fn($picture) => Image::delete($picture->image));
                $clinic->Pictures()->delete();
                foreach ($request->file('images') as $image) {
                    $clinic->Pictures()->create([
                        'image' => $image
                    ]);
                }
            }

        return $this->successData(new ClinicResource($clinic->refresh()));
    }

    public function destroy(Clinic $clinic)
    {
        $clinic->Pictures->each(fn($picture) => Image::delete($picture->image));
        $clinic->delete();
        return $this->successMsg(__('apis.deleted'));
    }

//    public function destroy(Clinic $clinic): JsonResponse
//    {
//        $clinic->delete();
//
//        return response()->json(['result' => 'Clinic was deleted successfully'], 200);
//    }
}
