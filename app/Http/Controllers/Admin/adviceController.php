<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\advice\Store;
use App\Http\Requests\Admin\advice\Update;
use App\Models\Advice ;
use App\Traits\Report;


class adviceController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $advice = Advice::search(request()->searchArray)->paginate(30);
            $html = view('admin.advice.table' ,compact('advice'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.advice.index');
    }

    public function create()
    {
        return view('admin.advice.create');
    }


    public function store(Store $request)
    {
        Advice::create($request->validated());
        Report::addToLog('  اضافه نصيحة') ;
        return response()->json(['url' => route('admin.advice.index')]);
    }
    public function edit($id)
    {
        $advice = Advice::findOrFail($id);
        return view('admin.advice.edit' , ['advice' => $advice]);
    }

    public function update(Update $request, $id)
    {
        $advice = Advice::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل نصيحة') ;
        return response()->json(['url' => route('admin.advice.index')]);
    }

    public function show($id)
    {
        $advice = Advice::findOrFail($id);
        return view('admin.advice.show' , ['advice' => $advice]);
    }
    public function destroy($id)
    {
        $advice = Advice::findOrFail($id)->delete();
        Report::addToLog('  حذف نصيحة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Advice::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من النصائح') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
