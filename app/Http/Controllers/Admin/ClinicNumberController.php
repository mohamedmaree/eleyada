<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\clinicnumbers\Store;
use App\Http\Requests\Admin\clinicnumbers\Update;
use App\Models\ClinicNumber ;
use App\Traits\Report;


class ClinicNumberController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $clinicnumbers = ClinicNumber::search(request()->searchArray)->paginate(30);
            $html = view('admin.clinicnumbers.table' ,compact('clinicnumbers'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.clinicnumbers.index');
    }

    public function create()
    {
        return view('admin.clinicnumbers.create');
    }


    public function store(Store $request)
    {
        ClinicNumber::create($request->validated());
        Report::addToLog('  اضافه ارقام العيادة') ;
        return response()->json(['url' => route('admin.clinicnumbers.index')]);
    }
    public function edit($id)
    {
        $clinicnumber = ClinicNumber::findOrFail($id);
        return view('admin.clinicnumbers.edit' , ['clinicnumber' => $clinicnumber]);
    }

    public function update(Update $request, $id)
    {
        $clinicnumber = ClinicNumber::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل ارقام العيادة') ;
        return response()->json(['url' => route('admin.clinicnumbers.index')]);
    }

    public function show($id)
    {
        $clinicnumber = ClinicNumber::findOrFail($id);
        return view('admin.clinicnumbers.show' , ['clinicnumber' => $clinicnumber]);
    }
    public function destroy($id)
    {
        $clinicnumber = ClinicNumber::findOrFail($id)->delete();
        Report::addToLog('  حذف ارقام العيادة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ClinicNumber::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من رقم العيادة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
