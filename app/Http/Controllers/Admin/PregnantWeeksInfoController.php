<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\pregnantweeksinfos\Store;
use App\Http\Requests\Admin\pregnantweeksinfos\Update;
use App\Models\PregnantWeeksInfo ;
use App\Traits\Report;


class PregnantWeeksInfoController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $pregnantweeksinfos = PregnantWeeksInfo::search(request()->searchArray)->orderBy('order','DESC')->paginate(30);
            $html = view('admin.pregnantweeksinfos.table' ,compact('pregnantweeksinfos'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.pregnantweeksinfos.index');
    }

    public function create()
    {
        return view('admin.pregnantweeksinfos.create');
    }


    public function store(Store $request)
    {
        PregnantWeeksInfo::create($request->validated());
        Report::addToLog('  اضافه بيانات اسبوع حمل') ;
        return response()->json(['url' => route('admin.pregnantweeksinfos.index')]);
    }
    public function edit($id)
    {
        $pregnantweeksinfo = PregnantWeeksInfo::findOrFail($id);
        return view('admin.pregnantweeksinfos.edit' , ['pregnantweeksinfo' => $pregnantweeksinfo]);
    }

    public function update(Update $request, $id)
    {
        $pregnantweeksinfo = PregnantWeeksInfo::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل بيانات اسبوع حمل') ;
        return response()->json(['url' => route('admin.pregnantweeksinfos.index')]);
    }

    public function show($id)
    {
        $pregnantweeksinfo = PregnantWeeksInfo::findOrFail($id);
        return view('admin.pregnantweeksinfos.show' , ['pregnantweeksinfo' => $pregnantweeksinfo]);
    }
    public function destroy($id)
    {
        $pregnantweeksinfo = PregnantWeeksInfo::findOrFail($id)->delete();
        Report::addToLog('  حذف بيانات اسبوع حمل') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PregnantWeeksInfo::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من بيانات اسابيع الحمل') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
