<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\clinics\Store;
use App\Http\Requests\Admin\clinics\Update;
use App\Models\Clinic ;
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
        return view('admin.clinics.index');
    }

    public function create()
    {
        return view('admin.clinics.create');
    }


    public function store(Store $request)
    {
        Clinic::create($request->validated());
        Report::addToLog('  اضافه العيادة') ;
        return response()->json(['url' => route('admin.clinics.index')]);
    }
    public function edit($id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('admin.clinics.edit' , ['clinic' => $clinic]);
    }

    public function update(Update $request, $id)
    {
        $clinic = Clinic::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل العيادة') ;
        return response()->json(['url' => route('admin.clinics.index')]);
    }

    public function show($id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('admin.clinics.show' , ['clinic' => $clinic]);
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
}
