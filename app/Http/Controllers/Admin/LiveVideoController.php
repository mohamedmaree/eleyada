<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\livevideos\Store;
use App\Http\Requests\Admin\livevideos\Update;
use App\Models\LiveVideo ;
use App\Traits\Report;


class LiveVideoController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $livevideos = LiveVideo::search(request()->searchArray)->paginate(30);
            $html = view('admin.livevideos.table' ,compact('livevideos'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.livevideos.index');
    }

    public function create()
    {
        return view('admin.livevideos.create');
    }


    public function store(Store $request)
    {
        LiveVideo::create($request->validated());
        Report::addToLog('  اضافه مقاطع فيديو') ;
        return response()->json(['url' => route('admin.livevideos.index')]);
    }
    public function edit($id)
    {
        $livevideo = LiveVideo::findOrFail($id);
        return view('admin.livevideos.edit' , ['livevideo' => $livevideo]);
    }

    public function update(Update $request, $id)
    {
        $livevideo = LiveVideo::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مقاطع فيديو') ;
        return response()->json(['url' => route('admin.livevideos.index')]);
    }

    public function show($id)
    {
        $livevideo = LiveVideo::findOrFail($id);
        return view('admin.livevideos.show' , ['livevideo' => $livevideo]);
    }
    public function destroy($id)
    {
        $livevideo = LiveVideo::findOrFail($id)->delete();
        Report::addToLog('  حذف مقاطع فيديو') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (LiveVideo::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من مقاطع فيديو') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
