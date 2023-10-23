<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\PregnantWeeksInfo;
use App\Http\Resources\Api\Patients\PregnantWeeksInfoResource;
use App\Http\Resources\Api\Patients\AdviceResource;
use App\Models\Advice;
use App\Http\Resources\Api\Settings\ImageResource;
use App\Models\Image;
use App\Models\LiveVideo;
use App\Http\Resources\Api\LiveVideoResource;
use App\Http\Resources\Api\DiscussionResource;
use App\Models\Discussion;
use App\Models\Doctor;
use App\Http\Resources\Api\DoctorsResource;
use App\Http\Resources\Api\ClinicsResource;
use App\Models\Clinic;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    use ResponseTrait;
    
    public function pregnantWeeks(Request $request){
        if(!$week = $request->week){
            $start_pregnant_date = auth()->user()->start_pregnant_date??date('Y-m-d');
            $now       = time(); 
            $your_date = strtotime($start_pregnant_date);
            $datediff  = $now - $your_date;
            $num_days  =  round($datediff / (60 * 60 * 24));
            $week      = ceil($num_days / 7);
        }
        $week_info = new PregnantWeeksInfoResource(PregnantWeeksInfo::where(['order' => $week])->first());

        $advices       = AdviceResource::collection(Advice::latest()->take($this->paginateNum())->get());
        $announcements = ImageResource::collection(Image::latest()->take($this->paginateNum())->get());
        $videos        = LiveVideoResource::collection(LiveVideo::latest()->take($this->paginateNum())->get());
        $discussion    = DiscussionResource::collection(Discussion::latest()->take($this->paginateNum())->get());
        
        //nearest clincs with own doctors
        // $doctors       = DoctorsResource::collection(Doctor::orderBy('name','ASC')->take($this->paginateNum())->get());
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

        $near_clinics = ClinicsResource::collection(Clinic::whereBetween('lng', [$minLng, $maxLng])->whereBetween('lat', [$minLat, $maxLat])->orderBy(DB::raw("(POW((lng-$lng),2) + POW((lat-$lat),2))"),'ASC')->take($this->paginateNum())->get());
        return $this->successData(['week_info'        => $week_info ,
                                   'advices'          => $advices,
                                //    'doctors'          => $doctors,
                                   'clinics'          => $near_clinics,
                                   'notifications'    => $announcements,
                                   'videos'           => $videos,
                                   'discussion'       => $discussion,
                                ]);
    }

    public function periodTracking(Request $request){
        $advices       = AdviceResource::collection(Advice::latest()->take($this->paginateNum())->get());
        $announcements = ImageResource::collection(Image::latest()->take($this->paginateNum())->get());
        $videos        = LiveVideoResource::collection(LiveVideo::latest()->take($this->paginateNum())->get());
        $discussion    = DiscussionResource::collection(Discussion::latest()->take($this->paginateNum())->get());
        $contraplan_fail_date = (auth()->user()->intercourse_date)? date("Y-m-d H:i:s", strtotime('+72 hours', strtotime(auth()->user()->intercourse_date))) : null;
        $still_minutes = 0;
        if($contraplan_fail_date){
            $start = strtotime('now');
            $end   = strtotime($contraplan_fail_date);
            $still_minutes = ($end - $start) / 60;
        }

        //nearest clincs with own doctors
        // $doctors       = DoctorsResource::collection(Doctor::orderBy('name','ASC')->take($this->paginateNum())->get());
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

        $near_clinics = ClinicsResource::collection(Clinic::whereBetween('lng', [$minLng, $maxLng])->whereBetween('lat', [$minLat, $maxLat])->orderBy(DB::raw("(POW((lng-$lng),2) + POW((lat-$lat),2))"),'ASC')->take($this->paginateNum())->get());

        return $this->successData(['next_period_days' => 0 ,
                                   'intercourse_date' => auth()->user()->intercourse_date,
                                   'contraplan_fail_date' => $contraplan_fail_date,
                                   'pill_taken_date'  => auth()->user()->pill_taken_date ,
                                   'still_time'       => auth()->user()->pill_taken_date ? null : convertToHoursMins($still_minutes),
                                   
                                   'period_date'         => auth()->user()->period_date,
                                   'fertility_date'      => null,
                                   
                                   'advices'          => $advices,
                                //    'doctors'          => $doctors,
                                   'clinics'          => $near_clinics,
                                   'notifications'    => $announcements,
                                   'videos'           => $videos,
                                   'discussion'       => $discussion,
                                ]);
    }

    public function advices(){
        return $this->successData(AdviceResource::collection(Advice::latest()->get()));
    }

    public function adviceDetails(Advice $advice){
        return $this->successData(new AdviceResource($advice));
    }

    public function videoDetails(LiveVideo $video){
        return $this->successData(new LiveVideoResource($video));
    }
}
