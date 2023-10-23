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
use App\Http\Resources\Api\ClinicsCollection;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    use ResponseTrait;

    public function index(){
        $clinics = ClinicResource::collection(auth()->user()->clinics);
        return $this->successData($clinics);
    }

    public function nearestClinics(Request $request){
        $R = 3960;  // earth's mean radius
        $rad = 1000;//$max_distance;
        // first-cut bounding box (in degrees)
        $lat = $request->lat;
        $lng = $request->lng;
        $lat = ($lat)??30.123456;
        $lng = ($lng)??30.123456;
        $maxLat = $lat + rad2deg($rad/$R);
        $minLat = $lat - rad2deg($rad/$R);
        // compensate for degrees longitude getting smaller with increasing latitude
        $maxLng = $lng + rad2deg($rad/$R/cos(deg2rad($lat)));
        $minLng = $lng - rad2deg($rad/$R/cos(deg2rad($lat)));
    
        $maxLat=number_format((float)$maxLat, 6, '.', '');
        $minLat=number_format((float)$minLat, 6, '.', '');
        $maxlng=number_format((float)$maxLng, 6, '.', '');
        $minLng=number_format((float)$minLng, 6, '.', '');

        $near_clinics = Clinic::whereBetween('lng', [$minLng, $maxLng])->whereBetween('lat', [$minLat, $maxLat])->orderBy(DB::raw("(POW((lng-$lng),2) + POW((lat-$lat),2))"),'ASC')->paginate($this->paginateNum());
        return $this->successData(new ClinicsCollection($near_clinics));
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
                'lat' => $request['lat'],
                'lng' => $request['lng'],
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
                'location_link' => $request['location_link'] ?? $clinic->location_link,
                'lat' => $request['lat'] ?? $clinic->lat,
                'lng' => $request['lng'] ?? $clinic->lng,
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
