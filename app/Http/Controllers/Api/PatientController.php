<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\PregnantWeeksInfo;
use App\Http\Resources\Api\Patients\PregnantWeeksInfoResource;

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
        return $this->successData($week_info);
    }

}
