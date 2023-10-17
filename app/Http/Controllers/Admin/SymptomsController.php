<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\symptoms\Store;
use App\Http\Requests\Admin\symptoms\Update;
use App\Models\Symptoms ;
use App\Traits\Report;


class SymptomsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $symptoms = Symptoms::search(request()->searchArray)->paginate(30);
            $html = view('admin.symptoms.table' ,compact('symptoms'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.symptoms.index');
    }

    public function create()
    {
        return view('admin.symptoms.create');
    }


    public function store(Store $request)
    {
        Symptoms::create($request->validated());
        Report::addToLog('  اضافه الأعراض') ;
        return response()->json(['url' => route('admin.symptoms.index')]);
    }
    public function edit($id)
    {
        $symptoms = Symptoms::findOrFail($id);
        return view('admin.symptoms.edit' , ['symptoms' => $symptoms]);
    }

    public function update(Update $request, $id)
    {
        $symptoms = Symptoms::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل الأعراض') ;
        return response()->json(['url' => route('admin.symptoms.index')]);
    }

    public function show($id)
    {
        $symptoms = Symptoms::findOrFail($id);
        return view('admin.symptoms.show' , ['symptoms' => $symptoms]);
    }
    public function destroy($id)
    {
        $symptoms = Symptoms::findOrFail($id)->delete();
        Report::addToLog('  حذف الأعراض') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Symptoms::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الأعراض') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
