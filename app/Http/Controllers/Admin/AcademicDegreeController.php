<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\academicdegrees\Store;
use App\Http\Requests\Admin\academicdegrees\Update;
use App\Models\AcademicDegree ;
use App\Traits\Report;


class AcademicDegreeController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $academicdegrees = AcademicDegree::search(request()->searchArray)->paginate(30);
            $html = view('admin.academicdegrees.table' ,compact('academicdegrees'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.academicdegrees.index');
    }

    public function create()
    {
        return view('admin.academicdegrees.create');
    }


    public function store(Store $request)
    {
        AcademicDegree::create($request->validated());
        Report::addToLog('  اضافه درجة علمية') ;
        return response()->json(['url' => route('admin.academicdegrees.index')]);
    }
    public function edit($id)
    {
        $academicdegree = AcademicDegree::findOrFail($id);
        return view('admin.academicdegrees.edit' , ['academicdegree' => $academicdegree]);
    }

    public function update(Update $request, $id)
    {
        $academicdegree = AcademicDegree::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل درجة علمية') ;
        return response()->json(['url' => route('admin.academicdegrees.index')]);
    }

    public function show($id)
    {
        $academicdegree = AcademicDegree::findOrFail($id);
        return view('admin.academicdegrees.show' , ['academicdegree' => $academicdegree]);
    }
    public function destroy($id)
    {
        $academicdegree = AcademicDegree::findOrFail($id)->delete();
        Report::addToLog('  حذف درجة علمية') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (AcademicDegree::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من  الدرجات العلمية') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
