<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\specialities\Store;
use App\Http\Requests\Admin\specialities\Update;
use App\Models\Speciality ;
use App\Traits\Report;


class SpecialityController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $specialities = Speciality::search(request()->searchArray)->paginate(30);
            $html = view('admin.specialities.table' ,compact('specialities'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.specialities.index');
    }

    public function create()
    {
        return view('admin.specialities.create');
    }


    public function store(Store $request)
    {
        Speciality::create($request->validated());
        Report::addToLog('  اضافه التخصص') ;
        return response()->json(['url' => route('admin.specialities.index')]);
    }
    public function edit($id)
    {
        $speciality = Speciality::findOrFail($id);
        return view('admin.specialities.edit' , ['speciality' => $speciality]);
    }

    public function update(Update $request, $id)
    {
        $speciality = Speciality::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل التخصص') ;
        return response()->json(['url' => route('admin.specialities.index')]);
    }

    public function show($id)
    {
        $speciality = Speciality::findOrFail($id);
        return view('admin.specialities.show' , ['speciality' => $speciality]);
    }
    public function destroy($id)
    {
        $speciality = Speciality::findOrFail($id)->delete();
        Report::addToLog('  حذف التخصص') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Speciality::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من التخصصات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
