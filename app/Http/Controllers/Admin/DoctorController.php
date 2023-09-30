<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\doctors\Store;
use App\Http\Requests\Admin\doctors\Update;
use App\Models\Doctor ;
use App\Traits\Report;


class DoctorController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $doctors = Doctor::search(request()->searchArray)->paginate(30);
            $html = view('admin.doctors.table' ,compact('doctors'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.doctors.index');
    }

    public function create()
    {
        return view('admin.doctors.create');
    }


    public function store(Store $request)
    {
        Doctor::create($request->validated());
        Report::addToLog('  اضافه الطبيب') ;
        return response()->json(['url' => route('admin.doctors.index')]);
    }
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.edit' , ['doctor' => $doctor]);
    }

    public function update(Update $request, $id)
    {
        $doctor = Doctor::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل الطبيب') ;
        return response()->json(['url' => route('admin.doctors.index')]);
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.show' , ['doctor' => $doctor]);
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
