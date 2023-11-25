<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\doctors\Store;
use App\Http\Requests\Admin\doctors\Update;
use App\Models\Doctor ;
use App\Traits\Report;
use App\Models\Country ;
use App\Models\SiteSetting;
use App\Models\Speciality ;
use App\Models\AcademicDegree ;

class DoctorController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $doctors = Doctor::search(request()->searchArray)->paginate(30);
            $html = view('admin.doctors.table' ,compact('doctors'))->render() ;
            return response()->json(['html' => $html]);
        }
        $specialities = Speciality::orderBy('name','ASC')->get() ; 
        $academic_degrees = AcademicDegree::orderBy('name','ASC')->get() ; 
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        return view('admin.doctors.index',get_defined_vars());
    }

    public function create()
    {
        $specialities = Speciality::orderBy('name','ASC')->get(); 
        $academic_degrees = AcademicDegree::orderBy('name','ASC')->get(); 
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        return view('admin.doctors.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        Doctor::create($request->validated());
        Report::addToLog('  اضافه الطبيب') ;
        return response()->json(['url' => route('admin.doctors.index')]);
    }
    public function edit($id)
    {
        $row = Doctor::findOrFail($id);
        $specialities = Speciality::orderBy('name','ASC')->get(); 
        $academic_degrees = AcademicDegree::orderBy('name','ASC')->get(); 
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        return view('admin.doctors.edit',get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $doctor = Doctor::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل الطبيب') ;
        return response()->json(['url' => route('admin.doctors.index')]);
    }

    public function show($id)
    {
        $row = Doctor::findOrFail($id);
        $specialities = Speciality::orderBy('name','ASC')->get(); 
        $academic_degrees = AcademicDegree::orderBy('name','ASC')->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get(); 
        return view('admin.doctors.show',get_defined_vars());
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id)->delete();
        Report::addToLog('  حذف الطبيب') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Doctor::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الأطباء') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
