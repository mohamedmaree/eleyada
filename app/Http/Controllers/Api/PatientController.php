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
        $doctors       = DoctorsResource::collection(Doctor::orderBy('name','ASC')->take($this->paginateNum())->get());
        return $this->successData(['week_info'        => $week_info ,
                                   'advices'          => $advices,
                                   'doctors'          => $doctors,
                                   'notifications'    => $announcements,
                                   'videos'           => $videos,
                                   'discussion'       => $discussion,
                                ]);
    }

    public function periodTracking(){
        $advices       = AdviceResource::collection(Advice::latest()->take($this->paginateNum())->get());
        $announcements = ImageResource::collection(Image::latest()->take($this->paginateNum())->get());
        $videos        = LiveVideoResource::collection(LiveVideo::latest()->take($this->paginateNum())->get());
        $discussion    = DiscussionResource::collection(Discussion::latest()->take($this->paginateNum())->get());
        $doctors       = DoctorsResource::collection(Doctor::orderBy('name','ASC')->take($this->paginateNum())->get());
        $contraplan_fail_date = (auth()->user()->intercourse_date)? date("Y-m-d H:i:s", strtotime('+72 hours', strtotime(auth()->user()->intercourse_date))) : null;
        $still_minutes = 0;
        if($contraplan_fail_date){
            $start = strtotime('now');
            $end   = strtotime($contraplan_fail_date);
            $still_minutes = ($end - $start) / 60;
        }
        return $this->successData(['next_period_days' => 0 ,
                                   'intercourse_date' => auth()->user()->intercourse_date,
                                   'contraplan_fail_date' => $contraplan_fail_date,
                                   'pill_taken_date'  => auth()->user()->pill_taken_date ,
                                   'still_time'       => auth()->user()->pill_taken_date ? null : convertToHoursMins($still_minutes),
                                   'advices'          => $advices,
                                   'doctors'          => $doctors,
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
