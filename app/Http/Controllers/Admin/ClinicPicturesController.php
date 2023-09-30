<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\clinicpictures\Store;
use App\Http\Requests\Admin\clinicpictures\Update;
use App\Models\ClinicPictures ;
use App\Traits\Report;


class ClinicPicturesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $clinicpictures = ClinicPictures::search(request()->searchArray)->paginate(30);
            $html = view('admin.clinicpictures.table' ,compact('clinicpictures'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.clinicpictures.index');
    }

    public function create()
    {
        return view('admin.clinicpictures.create');
    }


    public function store(Store $request)
    {
        ClinicPictures::create($request->validated());
        Report::addToLog('  اضافه صور العيادة') ;
        return response()->json(['url' => route('admin.clinicpictures.index')]);
    }
    public function edit($id)
    {
        $clinicpictures = ClinicPictures::findOrFail($id);
        return view('admin.clinicpictures.edit' , ['clinicpictures' => $clinicpictures]);
    }

    public function update(Update $request, $id)
    {
        $clinicpictures = ClinicPictures::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل صور العيادة') ;
        return response()->json(['url' => route('admin.clinicpictures.index')]);
    }

    public function show($id)
    {
        $clinicpictures = ClinicPictures::findOrFail($id);
        return view('admin.clinicpictures.show' , ['clinicpictures' => $clinicpictures]);
    }
    public function destroy($id)
    {
        $clinicpictures = ClinicPictures::findOrFail($id)->delete();
        Report::addToLog('  حذف صور العيادة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ClinicPictures::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من صور العيادة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
