<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\clinics\Store;
use App\Http\Requests\Admin\clinics\Update;
use App\Models\Clinic ;
use App\Models\Doctor ;
use App\Models\ClinicPictures ;
use App\Traits\Report;


class ClinicController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $clinics = Clinic::search(request()->searchArray)->paginate(30);
            $html = view('admin.clinics.table' ,compact('clinics'))->render() ;
            return response()->json(['html' => $html]);
        }
        $doctors = Doctor::orderBy('name','ASC')->get();
        return view('admin.clinics.index',get_defined_vars());
    }

    public function create()
    {
        $doctors = Doctor::orderBy('name','ASC')->get();
        return view('admin.clinics.create',get_defined_vars());
    }

    public function store(Store $request)
    {
        $clinc = Clinic::create($request->validated());
        if ($request->numbers) {
            $numbers = [];
            foreach ($request->numbers as $value) {
                $numbers[]['number'] = $value;
            }
            $clinc->Numbers()->createMany($numbers);
        }
        if ($request->hasFile('images')) {
            $this->storeFiles($clinc, $request->file('images'));
        }
        Report::addToLog('  اضافه العيادة') ;
        return response()->json(['url' => route('admin.clinics.index')]);
    }

    private function storeFiles($clinc, $files)
    {    
        foreach ($files as $file) {
            $clinc->Pictures()->create(['image' => $file]);
        }
    }

    public function edit($id)
    {
        $clinic = Clinic::findOrFail($id);
        $doctors = Doctor::orderBy('name','ASC')->get();
        return view('admin.clinics.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->update($request->validated());
        if ($request->numbers) {
            $clinic->Numbers()->delete();
            $numbers = [];
            foreach ($request->numbers as $value) {
                $numbers[]['number'] = $value;
            }
            $clinic->Numbers()->createMany($numbers);
        }
        if ($request->hasFile('images')) {
            $this->storeFiles($clinic, $request->file('images'));
        }
        Report::addToLog('  تعديل العيادة') ;
        return response()->json(['url' => route('admin.clinics.index')]);
    }

    public function show($id)
    {
        $clinic = Clinic::findOrFail($id);
        $doctors = Doctor::orderBy('name','ASC')->get();
        return view('admin.clinics.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id)->delete();
        Report::addToLog('  حذف العيادة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Clinic::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من العيادات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = ClinicPictures::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
